<div class="modern-form-wrapper">
    <div class="form-container">
        <div class="form-header">
            <div class="form-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <h3 class="form-title">{{ $form->title }}</h3>
            <p class="form-subtitle">Please fill out all required fields marked with <span class="required-star">*</span></p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('global.form.submit') }}" method="POST" class="modern-form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="form_id" value="{{ $form->id }}">
        <input type="hidden" name="classroom_id" value="{{ request('classroom_id') }}">

        @if(!auth()->guard('teacher')->check() && !auth()->guard('student')->check() && !auth()->check())
            <div class="guest-info">
                <div class="form-group">
                    <label class="form-label">Your Name <span class="text-danger">*</span></label>
                    <input type="text" name="submitter_name" class="form-control" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Your Email <span class="text-danger">*</span></label>
                    <input type="email" name="submitter_email" class="form-control" placeholder="Enter your email address" required>
                </div>
            </div>
        @endif



        @php
            $formElements = [];
            if (!empty($form->html_content)) {
                // Parse the HTML form data to extract form elements
                $dom = new DOMDocument();
                libxml_use_internal_errors(true); // Suppress HTML parsing warnings
                $dom->loadHTML('<div>' . $form->html_content . '</div>');
                libxml_clear_errors();
                $formElements = $dom->getElementsByTagName('div');
            }
        @endphp

        @if(empty($form->html_content))
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                This form has no fields configured yet.
            </div>
        @else
            @foreach($formElements as $element)
            @if($element->getAttribute('class') === 'form-element')
                <div class="form-group">
                    @php
                        $mainLabel = $element->getElementsByTagName('label')->item(0);
                        $inputs = $element->getElementsByTagName('input');
                        $textarea = $element->getElementsByTagName('textarea')->item(0);
                        $select = $element->getElementsByTagName('select')->item(0);
                        $formCheckDivs = [];

                        // Get all child divs with class 'form-check'
                        $childDivs = $element->getElementsByTagName('div');
                        foreach ($childDivs as $div) {
                            if ($div->getAttribute('class') === 'form-check') {
                                $formCheckDivs[] = $div;
                            }
                        }

                        $labelText = $mainLabel ? trim(strip_tags($mainLabel->textContent)) : '';
                        $isRequired = $mainLabel && strpos($mainLabel->textContent, '*') !== false;
                        $fieldType = 'text'; // Default field type
                        $fieldName = '';
                        $placeholder = '';
                        $rows = 3;

                        // Check if it's a select dropdown
                        if ($select) {
                            $fieldName = $select->getAttribute('name');
                            $fieldType = 'select';
                        }
                        // Check if it has form-check divs (radio/checkbox)
                        elseif (count($formCheckDivs) > 0) {
                            $firstInput = $formCheckDivs[0]->getElementsByTagName('input')->item(0);
                            $fieldType = $firstInput ? $firstInput->getAttribute('type') : 'radio';
                            $fieldName = $firstInput ? $firstInput->getAttribute('name') : '';
                        }
                        // Check if it's a single input field
                        elseif ($inputs->length >= 1) {
                            $input = $inputs->item(0);
                            $fieldName = $input->getAttribute('name');
                            $fieldType = $input->getAttribute('type') ?: 'text';
                            $placeholder = $input->getAttribute('placeholder');
                        }
                        // Check if it's textarea
                        elseif ($textarea) {
                            $fieldName = $textarea->getAttribute('name');
                            $fieldType = 'textarea';
                            $placeholder = $textarea->getAttribute('placeholder');
                            $rows = $textarea->getAttribute('rows') ?: 3;
                        }
                    @endphp

                    @if($labelText)
                        <label class="form-label">
                            {{ $labelText }}

                        </label>
                    @endif

                    @if($fieldType === 'select')
                        @php
                            $options = $select->getElementsByTagName('option');
                        @endphp
                        <select name="{{ $fieldName }}"
                                class="form-control"
                                {{ $isRequired ? 'required' : '' }}>
                            @for($i = 0; $i < $options->length; $i++)
                                @php
                                    $option = $options->item($i);
                                    $optionValue = $option->getAttribute('value');
                                    $optionText = trim(strip_tags($option->textContent));
                                @endphp
                                <option value="{{ $optionValue }}">{{ $optionText }}</option>
                            @endfor
                        </select>
                    @elseif($fieldType === 'textarea')
                        <textarea name="{{ $fieldName }}"
                                  class="form-control"
                                  rows="{{ $rows ?? 3 }}"
                                  placeholder="{{ $placeholder }}"
                                  {{ $isRequired ? 'required' : '' }}></textarea>
                    @elseif($fieldType === 'radio' || $fieldType === 'checkbox')
                        <div class="radio-checkbox-group">
                            @foreach($formCheckDivs as $loop => $checkDiv)
                                @php
                                    $input = $checkDiv->getElementsByTagName('input')->item(0);
                                    $label = $checkDiv->getElementsByTagName('label')->item(0);

                                    if ($input && $label) {
                                        $inputType = $input->getAttribute('type');
                                        $inputName = $input->getAttribute('name');
                                        $inputValue = $input->getAttribute('value');
                                        $inputId = $input->getAttribute('id');
                                        $optionLabel = trim(strip_tags($label->textContent));

                                        // For checkboxes, only first one should be required
                                        $isInputRequired = $isRequired && ($inputType === 'radio' || ($inputType === 'checkbox' && $loop === 0));
                                    }
                                @endphp
                                @if($input && $label)
                                    <div class="form-check">
                                        <input type="{{ $inputType }}"
                                               name="{{ $inputName }}{{ $inputType === 'checkbox' ? '[]' : '' }}"
                                               value="{{ $inputValue }}"
                                               id="{{ $inputId }}"
                                               class="form-check-input"
                                               {{ $isInputRequired ? 'required' : '' }}>
                                        <label class="form-check-label" for="{{ $inputId }}">
                                            {{ $optionLabel }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <input type="{{ $fieldType }}"
                               name="{{ $fieldName }}"
                               class="form-control"
                               @if($fieldType === 'file')
                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.txt"
                               @else
                                   placeholder="{{ $placeholder }}"
                               @endif
                               {{ $isRequired ? 'required' : '' }}>
                    @endif
                </div>
            @endif
            @endforeach

            <div class="form-actions">
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    Submit Form
                </button>
            </div>
        @endif
    </form>
    </div>
</div>

<style>
.modern-form-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 2rem 1rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

.form-container {
    width: 100%;
    max-width: 1000px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    overflow: hidden;
    border: 1px solid #e2e8f0;
}

.form-header {
    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
    padding: 2.5rem 2rem;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
}

.form-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.form-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    position: relative;
    z-index: 1;
}

.form-title {
    font-size: 1.875rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    position: relative;
    z-index: 1;
}

.form-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
    position: relative;
    z-index: 1;
}

.required-star {
    color: #fbbf24;
    font-weight: 600;
}

.modern-form {
    padding: 2rem;
}

.guest-info {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid #e2e8f0;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.2s ease;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: #0ea5e9;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    transform: translateY(-1px);
}

.form-control:hover {
    border-color: #d1d5db;
}

input[type="file"].form-control {
    padding: 0.5rem;
    background: #f8fafc;
    border: 2px dashed #e5e7eb;
    cursor: pointer;
    height: auto;
}

input[type="file"].form-control:hover {
    border-color: #0ea5e9;
    background: #f0f9ff;
}

input[type="file"].form-control:focus {
    border-color: #0ea5e9;
    background: #f0f9ff;
}


select.form-control {
    cursor: pointer;
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    height: auto;
    padding-right: 2.5rem;
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.radio-checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    transition: all 0.2s ease;
}

.form-check:hover {
    background: #f1f5f9;
    border-color: #0ea5e9;
}

.form-check-input {
    width: 18px;
    height: 18px;
    margin: 0;
    accent-color: #0ea5e9;
}

.form-check-label {
    margin: 0;
    font-weight: 500;
    color: #374151;
    cursor: pointer;
    flex: 1;
}

.success-alert {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    border-radius: 12px;
    padding: 1rem;
    margin: 0 2rem 2rem;
}

.alert-icon {
    width: 40px;
    height: 40px;
    background: #10b981;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.alert-content strong {
    color: #065f46;
    font-weight: 600;
    display: block;
    margin-bottom: 0.25rem;
}

.alert-content p {
    color: #047857;
    margin: 0;
    font-size: 0.875rem;
}

.form-actions {
    margin-top: 2rem;
    text-align: center;
}

.submit-btn {
    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    min-width: 160px;
    justify-content: center;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.3);
}

.submit-btn:active {
    transform: translateY(0);
}

.alert-warning {
    background: #fef3c7;
    border: 1px solid #fbbf24;
    border-radius: 12px;
    padding: 1rem;
    color: #92400e;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

@media (max-width: 768px) {
    .modern-form-wrapper {
        padding: 1rem;
        min-height: auto;
    }

    .form-container {
        border-radius: 16px;
    }

    .form-header {
        padding: 2rem 1.5rem;
    }

    .modern-form {
        padding: 1.5rem;
    }

    .form-title {
        font-size: 1.5rem;
    }

    .success-alert {
        margin: 0 1.5rem 1.5rem;
    }
}

@media (max-width: 480px) {
    .form-header {
        padding: 1.5rem 1rem;
    }

    .modern-form {
        padding: 1rem;
    }

    .form-title {
        font-size: 1.25rem;
    }

    .submit-btn {
        width: 100%;
    }
}
</style>

<style>
.shortcode-form-container {
    max-width: 1000px;
    margin: 20px 0;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-header {
    margin-bottom: 2rem;
    text-align: center;
}

.form-title {
    color: #1e293b;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.form-description {
    color: #64748b;
    font-size: 1rem;
    margin: 0;
}

.shortcode-dynamic-form .form-group {
    margin-bottom: 1.5rem;
}

.shortcode-dynamic-form .form-label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.shortcode-dynamic-form .form-control {
    width: 100%;
    padding: 0px 0.75rem;
    border: 2px solid #e5e7eb;
    border-radius: 20px;
    font-size: 1rem;
    transition: all 0.2s ease;
    resize: none;
}

.shortcode-dynamic-form .form-control:focus {
    outline: none;
    border-color: #0ea5e9;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
}

.shortcode-dynamic-form .btn {
    width: 100%;
    padding: 0.875rem 1.5rem;
    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-top: 1rem;
}

.shortcode-dynamic-form .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
}

.text-danger {
    color: #ef4444;
}

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.alert-warning {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fcd34d;
}

.alert-success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.guest-info {
    background: #f8fafc;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    border: 2px dashed #e2e8f0;
}

.guest-info::before {
    content: '👤 Guest Information';
    display: block;
    font-weight: 600;
    color: #475569;
    margin-bottom: 1rem;
    font-size: 0.875rem;
}

.radio-checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-check-input {
    width: 1.25rem;
    height: 1.25rem;
    margin: 0;
    cursor: pointer;
}

.form-check-input[type="radio"] {
    border-radius: 50%;
}

.form-check-input[type="checkbox"] {
    border-radius: 4px;
}

.form-check-input:checked {
    background-color: #0ea5e9;
    border-color: #0ea5e9;
}


.form-check-label {
    font-weight: 400;
    color: #374151;
    cursor: pointer;
    margin: 0px 30px;
    font-size: 1rem;
}
</style>
