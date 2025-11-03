<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Form;
use App\Models\ClassroomForms;
class ClassroomController extends Controller
{
    public function index(Request $request, $id)
    {
        $classrooms = Classroom::where('teacher_id', auth()->user()->id)->get();
        $forms = Form::where('teacher_id', auth()->user()->id)->get();
        $classroomNames = $classrooms->pluck('name')->toArray();
        $classroomIds = $classrooms->pluck('id')->toArray();

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

        return view('teacher.classroom.showClass', compact('classrooms', 'classforms', 'classroomNames','classroomIds','forms','id'));
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
}
