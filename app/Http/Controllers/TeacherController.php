<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $forms = Form::where('teacher_id', Auth::id())->get();
        return view('teacher.dashboard',compact('forms'));
    }

    public function classroomInitialSetup()
    {
        $classrooms = Classroom::where('teacher_id', auth()->user()->id)->get();
        return view('teacher.classroom.classroomSetup', compact('classrooms'));
    }


}
