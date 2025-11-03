<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classroom;
use App\Models\ClassroomForms;
use App\Models\ClassroomStudents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function dashboard()
    {
        $studentId = Auth::guard('student')->id();
        return view('student.dashboard', [
            'studentId' => $studentId
        ]);
    }

    public function viewClasses()
    {
        $studentId = Auth::guard('student')->id();
        $classes = Classroom::all();
        $joinedClassIds = ClassroomStudents::where('student_id', $studentId)->pluck('classroom_id')->toArray();

        return view('student.classroom.viewClass', [
            'classes' => $classes,
            'joinedClassIds' => $joinedClassIds
        ]);
    }

    public function viewAssignedForms($id)
    {
        $classroom = Classroom::find($id);
        if (!$classroom) {
            return redirect()->back()->with('error', 'Classroom not found.');
        }

        $forms = ClassroomForms::where('classroom_id', $id)->with('form')->get();

        return view('student.classroom.viewAssignedForms', [
            'classroom' => $classroom,
            'forms' => $forms
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
            'classrooms' => $classrooms
        ]);
    }
}
