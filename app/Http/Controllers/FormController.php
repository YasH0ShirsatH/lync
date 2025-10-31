<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function formBuilder()
    {
        return view('teacher.formBuilder');
    }

    public function store(Request $request)
        {
            $request->validate([
                'html_content' => 'required|string',
            ]);

            $form = Form::create([

                'teacher_id' => auth()->id(),
                'title' => $request->input('title', 'Untitled Form'),
                'html_content' => $request->input('html_content'),
            ]);

            return response()->json([
                'success' => true,
                'id' => $form->id,
                'message' => 'Form saved successfully!'
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
}
