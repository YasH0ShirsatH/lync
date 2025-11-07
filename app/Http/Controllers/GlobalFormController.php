<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlobalFormSubmission;
use App\Models\Form;
use App\Models\User;

class GlobalFormController extends Controller
{
    public function submitForm(Request $request)
    {
        $request->validate([
            'form_id' => 'required|exists:forms,id',
        ]);

        // Determine submitter type and user info
        $submitterType = 'guest';
        $userId = null;
        $submitterName = $request->submitter_name;
        $submitterEmail = $request->submitter_email;

        // Check teacher guard first
        if (auth()->guard('teacher')->check()) {
            $user = auth()->guard('teacher')->user();
            $userId = $user->id;
            $submitterName = $user->name;
            $submitterEmail = $user->email;
            $submitterType = 'teacher';
        }
        // Check student guard
        elseif (auth()->guard('student')->check()) {
            $user = auth()->guard('student')->user();
            $userId = $user->id;
            $submitterName = $user->name;
            $submitterEmail = $user->email;
            $submitterType = 'student';
        }
        // Check default guard
        elseif (auth()->check()) {
            $user = auth()->user();
            $userId = $user->id;
            $submitterName = $user->name;
            $submitterEmail = $user->email;
            $submitterType = $user->role ?? 'user';
        }
        // If no authentication, validate guest fields
        else {
            $request->validate([
                'submitter_name' => 'required|string|max:255',
                'submitter_email' => 'required|email|max:255',
            ]);
        }

        // Get form to extract field labels
        $form = Form::findOrFail($request->form_id);

        // Handle file uploads
        $uploadedFiles = [];
        if (count($request->allFiles()) > 0) {
            foreach ($request->allFiles() as $fieldName => $files) {
                if (!is_array($files)) {
                    $files = [$files];
                }
                
                $filePaths = [];
                foreach ($files as $file) {
                    if ($file->isValid()) {
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $filePath = $file->storeAs('form_uploads', $fileName, 'public');
                        $filePaths[] = [
                            'original_name' => $file->getClientOriginalName(),
                            'stored_name' => $fileName,
                            'path' => $filePath,
                            'size' => $file->getSize(),
                            'mime_type' => $file->getMimeType()
                        ];
                    }
                }
                $uploadedFiles[$fieldName] = count($filePaths) === 1 ? $filePaths[0] : $filePaths;
            }
        }

        // Extract form responses (exclude system fields)
        $formResponses = $request->except([
            '_token', 'form_id', 'submitter_name', 'submitter_email', 'classroom_id'
        ]);
        
        // Remove file fields from form responses as they're handled separately
        foreach (array_keys($uploadedFiles) as $fileField) {
            unset($formResponses[$fileField]);
        }

        // Parse form HTML to get field labels
        $fieldLabels = [];
        if (!empty($form->html_content)) {
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML('<div>' . $form->html_content . '</div>');
            libxml_clear_errors();

            $formElements = $dom->getElementsByTagName('div');
            foreach ($formElements as $element) {
                if ($element->getAttribute('class') === 'form-element') {
                    $label = $element->getElementsByTagName('label')->item(0);
                    $inputs = $element->getElementsByTagName('input');
                    $textarea = $element->getElementsByTagName('textarea')->item(0);
                    $select = $element->getElementsByTagName('select')->item(0);

                    $labelText = $label ? trim(strip_tags($label->textContent)) : '';
                    $fieldName = '';

                    if ($select) {
                        $fieldName = $select->getAttribute('name');
                    } elseif ($inputs->length > 0) {
                        $fieldName = $inputs->item(0)->getAttribute('name');
                    } elseif ($textarea) {
                        $fieldName = $textarea->getAttribute('name');
                    }

                    if ($fieldName && $labelText) {
                        $fieldLabels[$fieldName] = $labelText;
                    }
                }
            }
        }

        // Combine responses with labels
        $responsesWithLabels = [];
        foreach ($formResponses as $fieldName => $value) {
            $baseFieldName = str_replace('[]', '', $fieldName);
            $label = $fieldLabels[$baseFieldName] ?? $fieldLabels[$fieldName] ?? ucfirst(str_replace('_', ' ', $baseFieldName));
            $responsesWithLabels[$label] = $value;
        }
        
        // Add uploaded files to responses
        foreach ($uploadedFiles as $fieldName => $fileData) {
            $baseFieldName = str_replace('[]', '', $fieldName);
            $label = $fieldLabels[$baseFieldName] ?? $fieldLabels[$fieldName] ?? ucfirst(str_replace('_', ' ', $baseFieldName));
            $responsesWithLabels[$label] = $fileData;
        }

        // Create submission
        GlobalFormSubmission::create([
            'form_id' => $request->form_id,
            'submitter_name' => $submitterName,
            'submitter_email' => $submitterEmail,
            'submitter_type' => $submitterType,
            'user_id' => $userId,
            'form_responses' => $responsesWithLabels,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Form submitted successfully!');
    }

    public function index($formId)
    {
        $form = Form::findOrFail($formId);
        $submissions = GlobalFormSubmission::where('form_id', $formId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('forms.submissions', compact('form', 'submissions'));
    }

    public function show($id)
    {
        $submission = GlobalFormSubmission::with('form')->findOrFail($id);
        return view('teacher.cms.global_form_view', compact('submission'));
    }

    public function allSubmissions()
    {
        $submissions = GlobalFormSubmission::with('form')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('teacher.cms.global_forms', compact('submissions'));
    }

    public function serveFile($filename)
    {
        $path = storage_path('app/public/form_uploads/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }
        
        return response()->file($path);
    }
}
