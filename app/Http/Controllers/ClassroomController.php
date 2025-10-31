<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Form;
use App\Models\ClassroomForms;
class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::where('teacher_id', auth()->user()->id)->get();
        $forms = Form::where('teacher_id', auth()->user()->id)->get();
        $classroomNames = $classrooms->pluck('name')->toArray();
        $classroomIds = $classrooms->pluck('id')->toArray();

        $classforms = ClassroomForms::whereIn('classroom_id', $classroomIds)->get();

        return view('teacher.classroom.showClass', compact('classrooms', 'classforms', 'classroomNames','classroomIds','forms'));
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
}
