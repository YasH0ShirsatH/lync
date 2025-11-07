<?php

namespace App\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use App\Models\Form;

class FormShortcode
{
    public function __invoke(ShortcodeInterface $shortcode)
    {
        // Get the form_id parameter from shortcode
        $formId = $shortcode->getParameter('form_id', null);

        if (!$formId) {
            return '<p>Form ID is required</p>';
        }

        // Fetch form from database
        $form = Form::find($formId);

        if (!$form) {
            return '<p>Form not found</p>';
        }

        // Return rendered view with form data
        return view('shortcodes.form_display', compact('form'))->render();
    }

}
