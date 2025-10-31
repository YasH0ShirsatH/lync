<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
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
        return view('teacher.classroom.classroomSetup');
    }


}
