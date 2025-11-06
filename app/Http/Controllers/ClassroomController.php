<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Form;
use App\Models\ClassroomStudents;
use App\Models\ClassroomForms;
use App\Models\FormSubmission;
class ClassroomController extends Controller
{
    public function index(Request $request, $id)
    {
        $classrooms = Classroom::where('teacher_id', auth()->user()->id)->get();
        $forms = Form::where('teacher_id', auth()->user()->id)->get();
        $classroomNames = $classrooms->pluck('name')->toArray();
        $classroomIds = $classrooms->pluck('id')->toArray();
        $students = ClassroomStudents::where('classroom_id', $id)->get();


        $classforms = ClassroomForms::where('classroom_id', $id)
            ->with(['form', 'classroom'])
            ->get();

        // Get all classroom relationships for each form to show complete classroom badges
        $classforms = $classforms->map(function($classform) {
            $classform->allClassrooms = ClassroomForms::where('form_id', $classform->form_id)
                ->with('classroom')
                ->get();
            return $classform;
        });

        return view('teacher.classroom.showClass', compact('classrooms', 'classforms', 'classroomNames','classroomIds','forms','id','students'));
    }

    public function createClassroom(Request $request)
    {
        $classroom = new Classroom();
        $classroom->name = $request->class_name;
        $classroom->description = $request->description;
        $classroom->teacher_id = auth()->user()->id;
        $classroom->password = bcrypt($request->password);
        if($classroom->save())
        {
            return redirect()->route('teacher.classroom.setup')->with('success', 'Classroom created successfully.');
        }
        else{
            return redirect()->back()->with('error', 'Failed to create classroom.');
        }
    }

    public function deleteClass($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();

        return redirect()->route('teacher.classroom.setup')->with('delete', 'Classroom deleted successfully.');
    }

    public function removeForm($classroomId, $formId)
    {
        ClassroomForms::where('classroom_id', $classroomId)
                     ->where('form_id', $formId)
                     ->delete();

        return redirect()->back()->with('success', 'Form removed from classroom successfully.');
    }

    public function viewAllResponses($classroomId, $formId)
    {
        $classroom = Classroom::findOrFail($classroomId);
        $form = Form::with('submissions')->findOrFail($formId);

        $submissions = FormSubmission::where('form_id', $formId)
            ->with('student')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('teacher.classroom.viewResponses', compact('classroom', 'form', 'submissions'));
    }

    public function viewStudentResponses($classroomId, $studentId)
    {
        $classroom = Classroom::findOrFail($classroomId);
        $student = \App\Models\User::findOrFail($studentId);
        
        $submissions = FormSubmission::where('student_id', $studentId)
            ->whereIn('form_id', 
                ClassroomForms::where('classroom_id', $classroomId)->pluck('form_id')
            )
            ->with('form')
            ->get();
        
        return view('teacher.classroom.viewStudentResponses', compact('classroom', 'student', 'submissions'));
    }

    public function viewSubmission($submissionId)
    {
        $submission = FormSubmission::with(['form', 'student'])->findOrFail($submissionId);
        
        return view('teacher.classroom.viewSubmission', compact('submission'));
    }

    public function updateSubmissionRemark(Request $request, $submissionId)
    {
        $request->validate([
            'obtained_marks' => 'nullable|numeric|min:0',
            'total_marks' => 'nullable|numeric|min:1',
            'teacher_comment' => 'nullable|string|max:1000'
        ]);

        $submission = FormSubmission::findOrFail($submissionId);
        $submission->rating = $request->obtained_marks;
        
        // Store marks format in comment field if both marks are provided
        if ($request->obtained_marks !== null && $request->total_marks !== null) {
            $marksInfo = $request->obtained_marks . '/' . $request->total_marks;
            $submission->comment = $request->teacher_comment ? $marksInfo . '|' . $request->teacher_comment : $marksInfo;
        } else {
            $submission->comment = $request->teacher_comment;
        }
        
        $submission->save();

        return redirect()->back()->with('success', 'Marks and remarks updated successfully!');
    }
}
