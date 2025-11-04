<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classroom;
use App\Models\ClassroomForms;
use App\Models\ClassroomStudents;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function dashboard()
    {
        $studentId = Auth::guard('student')->id();
        
        // Calculate statistics
        $joinedClassrooms = ClassroomStudents::where('student_id', $studentId)->count();
        $completedForms = FormSubmission::where('student_id', $studentId)->count();
        
        // Get unique assigned forms
        $totalAssignedForms = ClassroomForms::whereIn('classroom_id', 
            ClassroomStudents::where('student_id', $studentId)->pluck('classroom_id')
        )->distinct('form_id')->count('form_id');
        
        $pendingTasks = $totalAssignedForms - $completedForms;
        $completionRate = $totalAssignedForms > 0 ? round(($completedForms / $totalAssignedForms) * 100) : 100;
        
        return view('student.dashboard', [
            'joinedClassrooms' => $joinedClassrooms,
            'completedForms' => $completedForms,
            'pendingTasks' => $pendingTasks,
            'completionRate' => $completionRate
        ]);
    }

    public function viewClasses()
    {
        $studentId = Auth::guard('student')->id();
        $joinedClassIds = ClassroomStudents::where('student_id', $studentId)->pluck('classroom_id')->toArray();
        $classes = Classroom::whereNotIn('id', $joinedClassIds)->get();

        return view('student.classroom.viewClass', [
            'classes' => $classes
        ]);
    }

    public function viewAssignedForms($id)
    {
        $classroom = Classroom::find($id);
        if (!$classroom) {
            return redirect()->back()->with('error', 'Classroom not found.');
        }

        $studentId = Auth::guard('student')->id();
        $isEnrolled = ClassroomStudents::where('classroom_id', $id)
                                      ->where('student_id', $studentId)
                                      ->exists();
        
        if (!$isEnrolled) {
            return redirect()->back()->with('error', 'You are not enrolled in this classroom.');
        }

        $forms = ClassroomForms::where('classroom_id', $id)->with('form')->get();
        
        // Check submission status for each form
        $submittedFormIds = FormSubmission::where('student_id', $studentId)
                                         ->whereIn('form_id', $forms->pluck('form_id'))
                                         ->pluck('form_id')
                                         ->toArray();

        return view('student.classroom.viewAssignedForms', [
            'classroom' => $classroom,
            'forms' => $forms,
            'submittedFormIds' => $submittedFormIds
        ]);
    }

    public function showForm($classroom, $form)
    {
        $studentId = Auth::guard('student')->id();
        $formData = ClassroomForms::with('form')->find($form);

        if (!$formData) {
            return redirect()->back()->with('error', 'Form not found.');
        }

        // Check if already submitted and get submission
        $submission = FormSubmission::where('form_id', $formData->form_id)
                                   ->where('student_id', $studentId)
                                   ->first();
        
        $isSubmitted = $submission ? true : false;
        $formUpdatedAfterSubmission = false;
        
        if ($submission) {
            // Check if form was updated after submission
            $formUpdatedAfterSubmission = $formData->form->updated_at > $submission->form_version;
            
            // Update the flag in database if needed
            if ($formUpdatedAfterSubmission && !$submission->form_updated_after_submission) {
                $submission->update(['form_updated_after_submission' => true]);
            }
        }

        return view('student.classroom.showAssignedForms', [
            'form' => $formData,
            'isSubmitted' => $isSubmitted,
            'submission' => $submission,
            'formUpdatedAfterSubmission' => $formUpdatedAfterSubmission
        ]);
    }

    public function joinClass(Request $request)
    {
        $classroom = Classroom::find($request->classroom_id);

        if (!$classroom) {
            return response()->json(['success' => false, 'message' => 'Classroom not found']);
        }

        if (!Hash::check($request->password, $classroom->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password']);
        }

        $studentId = Auth::guard('student')->id();

        // Check if already joined
        $exists = ClassroomStudents::where('classroom_id', $request->classroom_id)
                                 ->where('student_id', $studentId)
                                 ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Already joined this class']);
        }

        ClassroomStudents::create([
            'classroom_id' => $request->classroom_id,
            'student_id' => $studentId
        ]);

        return response()->json(['success' => true, 'message' => 'Successfully joined the class!']);
    }

    public function viewJoinedClasses()
    {
        $studentId = Auth::guard('student')->id();

        $joinedClasses = ClassroomStudents::where('student_id', $studentId)->with('classroom')->get();
        $classrooms = $joinedClasses->map(function($entry) {
            return $entry->classroom;
        });
        return view('student.classroom.yourClass', [
            'joinedClasses' => $joinedClasses,
            'classrooms' => $classrooms,

        ]);
    }

    public function leaveClass(Request $request)
    {
        $studentId = Auth::guard('student')->id();

        $deleted = ClassroomStudents::where('classroom_id', $request->classroom_id)
                                   ->where('student_id', $studentId)
                                   ->delete();

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Successfully left the class!']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to leave class']);
    }

    public function submitForm(Request $request)
    {
        $studentId = Auth::guard('student')->id();
        $formId = $request->form_id;
        
        // Check if already submitted
        $existingSubmission = FormSubmission::where('form_id', $formId)
                                           ->where('student_id', $studentId)
                                           ->first();
        
        if ($existingSubmission) {
            return response()->json(['success' => false, 'message' => 'Form already submitted']);
        }
        
        // Get form's last updated time as version
        $form = \App\Models\Form::find($formId);
        
        FormSubmission::create([
            'form_id' => $formId,
            'student_id' => $studentId,
            'responses' => $request->responses,
            'form_version' => $form->updated_at
        ]);
        
        return response()->json(['success' => true, 'message' => 'Form submitted successfully!']);
    }

    public function viewAllAssignedForms()
    {
        $studentId = Auth::guard('student')->id();
        
        // Get all joined classrooms with their forms
        $joinedClassrooms = ClassroomStudents::where('student_id', $studentId)
                                            ->with(['classroom.classroomForms.form'])
                                            ->get();
        
        // Get submitted form IDs and update status
        $submittedFormIds = FormSubmission::where('student_id', $studentId)
                                         ->pluck('form_id')
                                         ->toArray();
        
        $formSubmissions = FormSubmission::where('student_id', $studentId)
                                        ->get()
                                        ->keyBy('form_id');
        
        return view('student.classroom.allAssignedForms', [
            'joinedClassrooms' => $joinedClassrooms,
            'submittedFormIds' => $submittedFormIds,
            'formSubmissions' => $formSubmissions
        ]);
    }
}
