<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
class ClassroomController extends Controller
{
    public function index()
    {
        return view('classroom.index');
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
