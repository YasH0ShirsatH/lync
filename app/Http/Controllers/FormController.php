<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;
use App\Models\ClassroomForms;
use App\Models\Form;

class FormController extends Controller
{
    public function formBuilder()
    {
        $classrooms = Classroom::where('teacher_id', auth()->id())->get();
        return view('teacher.formBuilder', compact('classrooms'));
    }

    public function store(Request $request)
        {
            $request->validate([
                'html_content' => 'required|string',
                'classroom' => 'required',
            ]);

            $form = Form::create([

                'teacher_id' => auth()->id(),
                'title' => $request->input('title', 'Untitled Form'),
                'html_content' => $request->input('html_content'),
            ]);

            foreach ($request->input('classroom') as $classroomId) {
                ClassroomForms::create([
                    'classroom_id' => $classroomId,
                    'form_id' => $form->id
                ]);
            }

            return response()->json([
                'success' => true,
                'id' => $form->id,
                'message' => 'Form saved successfully and added to classroom!'
            ]);
        }

    public function showForm($id)
    {
        $form = Form::findOrFail($id);
        return view('teacher.showform', compact('form'));
    }

    public function deleteForm($id)
    {
        $form = Form::findOrFail($id);
        $form->delete();

        return redirect()->route('teacher.dashboard')->with('success', 'Form deleted successfully.');
    }

    public function editForm($id)
    {
        $form = Form::findOrFail($id);
        $classroomId = ClassroomForms::where('form_id', $id)->pluck('classroom_id')->toArray();
        return view('teacher.editform', compact('form','id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'html_content' => 'required|string',
        ]);

        $form = Form::findOrFail($id);
        $form->update([
            'html_content' => $request->input('html_content'),
            'title' => $request->input('title', $form->title)
        ]);

        return response()->json([
            'success' => true,
            'id' => $form->id,
            'message' => 'Form updated successfully!'
        ]);
    }
}
