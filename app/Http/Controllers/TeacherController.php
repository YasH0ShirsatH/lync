<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Classroom;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {

        $forms = Form::where('teacher_id', Auth::id())->paginate(4);
        $submissions = FormSubmission::whereHas('form', function ($query) {
            $query->where('teacher_id', Auth::id());
        })->get();
        $classroomSetup = Classroom::where('teacher_id', auth()->user()->id)->get();

        return view('teacher.dashboard',compact('forms','classroomSetup','submissions'));
    }

    public function getForms(Request $request)
    {
        $query = Form::where('teacher_id', Auth::id());

        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $forms = $query->paginate(4);

        if ($request->ajax()) {
            $classroomSetup = Classroom::where('teacher_id', auth()->user()->id)->get();
            return response()->json([
                'html' => view('teacher.partials.forms', compact('forms', 'classroomSetup'))->render(),
                'pagination' => $forms->links('teacher.partials.pagination')->render()
            ]);
        }

        return redirect()->route('teacher.dashboard');
    }

    public function classroomInitialSetup()
    {
        $classrooms = Classroom::where('teacher_id', auth()->user()->id)->get();
        return view('teacher.classroom.classroomSetup', compact('classrooms'));
    }

    public function assignFormToClassrooms(Request $request)
    {
        $formId = $request->form_id;
        $classroomIds = $request->classroom_ids;

        foreach($classroomIds as $classroomId) {
            \App\Models\ClassroomForms::create([
                'form_id' => $formId,
                'classroom_id' => $classroomId
            ]);
        }

        return response()->json(['success' => true]);
    }


}
