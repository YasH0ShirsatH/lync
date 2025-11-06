<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Form - {{ $form->title }}</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #0ea5e9;
            --primary-blue-dark: #0369a1;
            --secondary-blue: #0284c7;
            --accent-blue: #38bdf8;
            --neutral-50: #f8fafc;
            --neutral-100: #f1f5f9;
            --neutral-200: #e2e8f0;
            --neutral-300: #cbd5e1;
            --neutral-400: #94a3b8;
            --neutral-500: #64748b;
            --neutral-600: #475569;
            --neutral-700: #334155;
            --neutral-800: #1e293b;
            --neutral-900: #0f172a;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-100) 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--neutral-800);
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.15);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(50%, -50%);
        }

        .page-title {
            font-weight: 700;
            font-size: 1.875rem;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .page-subtitle {
            opacity: 0.9;
            font-size: 1rem;
            margin: 0.5rem 0 0 0;
            position: relative;
            z-index: 1;
        }

        .btn-back {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            position: relative;
            z-index: 1;
        }

        .btn-back:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.3);
            color: white;
            transform: translateY(-1px);
        }

        /* Form Title Section */
        .title-section {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            margin-bottom: 2rem;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .section-title {
            font-weight: 600;
            font-size: 1.125rem;
            color: var(--neutral-800);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Form Elements Toolbar */
        .elements-toolbar {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            margin-bottom: 2rem;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .elements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0.75rem;
        }

        .element-btn {
            background: var(--neutral-50);
            border: 1px solid var(--neutral-200);
            border-radius: 8px;
            padding: 0.875rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--neutral-700);
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.375rem;
            text-align: center;
        }

        .element-btn:hover {
            background: var(--warning);
            border-color: var(--warning);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
        }

        .element-btn i {
            font-size: 1.125rem;
        }

        /* Form Canvas */
        .form-canvas {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--neutral-200);
            min-height: 400px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        /* Form Elements */
        .form-element {
            background: var(--neutral-50);
            border: 1px solid var(--neutral-200);
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            position: relative;
            transition: all 0.2s ease;
        }

        .form-element:hover {
            border-color: var(--warning);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.1);
        }

        .form-control, .form-select {
            border: 1px solid var(--neutral-300);
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--warning);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: var(--neutral-700);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-check {
            margin-bottom: 0.5rem;
        }

        .form-check-input:checked {
            background-color: var(--warning);
            border-color: var(--warning);
        }

        .form-check-label {
            font-size: 0.875rem;
            color: var(--neutral-600);
        }

        /* Element Controls */
        .remove-btn {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background: var(--danger);
            color: white;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-btn:hover {
            background: #dc2626;
            transform: scale(1.1);
        }

        .edit-title-btn {
            background: var(--warning);
            color: white;
            border: none;
            border-radius: 4px;
            width: 20px;
            height: 20px;
            font-size: 0.625rem;
            margin-left: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .edit-title-btn:hover {
            background: #d97706;
            transform: scale(1.1);
        }

        /* Element Controls */
        .element-controls {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid var(--neutral-200);
        }

        .required-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            color: var(--neutral-600);
        }

        .required-checkbox {
            width: 16px;
            height: 16px;
            accent-color: var(--warning);
        }

        /* Save Section */
        .save-section {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            text-align: center;
        }

        .btn-save {
            background: var(--warning);
            border-color: var(--warning);
            color: white;
            border-radius: 8px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .btn-save:hover {
            background: #d97706;
            border-color: #d97706;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 0 0.75rem;
            }

            .page-header {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .elements-grid {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 0.5rem;
            }

            .element-btn {
                padding: 0.75rem 0.5rem;
                font-size: 0.75rem;
            }

            .form-canvas {
                padding: 1.5rem;
            }

            .title-section,
            .elements-toolbar,
            .save-section {
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-4">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    <h1 class="page-title" id="pageTitle">
                        <i class="fas fa-edit me-2"></i>Edit Form: {{ $form->title }}
                    </h1>
                    <p class="page-subtitle">Modify and update your existing form</p>
                </div>
                <a href="{{ route('teacher.dashboard') }}" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Form Title Section -->
        <div class="title-section">
            <h3 class="section-title">
                <i class="fas fa-heading"></i>
                Form Title
            </h3>
            <input type="text" id="formTitle" class="form-control" value="{{ $form->title }}" placeholder="Enter form title">
        </div>

        <!-- Form Elements Toolbar -->
        <div class="elements-toolbar">
            <h3 class="section-title">
                <i class="fas fa-tools"></i>
                Add New Elements
            </h3>
            <div class="elements-grid">
                <button class="element-btn" onclick="addInput()">
                    <i class="fas fa-font"></i>
                    <span>Text Input</span>
                </button>
                <button class="element-btn" onclick="addTextarea()">
                    <i class="fas fa-align-left"></i>
                    <span>Textarea</span>
                </button>
                <button class="element-btn" onclick="addRadio()">
                    <i class="fas fa-dot-circle"></i>
                    <span>Radio Buttons</span>
                </button>
                <button class="element-btn" onclick="addCheckbox()">
                    <i class="fas fa-check-square"></i>
                    <span>Checkboxes</span>
                </button>
                <button class="element-btn" onclick="addSelect()">
                    <i class="fas fa-list"></i>
                    <span>Dropdown</span>
                </button>
                <button class="element-btn" onclick="addDate()">
                    <i class="fas fa-calendar"></i>
                    <span>Date Picker</span>
                </button>
                <button class="element-btn" onclick="addTel()">
                    <i class="fas fa-phone"></i>
                    <span>Phone Number</span>
                </button>
                <button class="element-btn" onclick="addFile()">
                    <i class="fas fa-file-upload"></i>
                    <span>File Upload</span>
                </button>
            </div>
        </div>

        <!-- Form Canvas -->
        <div id="formArea" class="form-canvas">
            {!! $form->html_content !!}
        </div>

        <!-- Save Section -->
        <div class="save-section">
            <button class="btn btn-save" onclick="updateForm()">
                <i class="fas fa-save me-2"></i>Update Form
            </button>
            <p class="mt-2 mb-0 text-muted" style="font-size: 0.875rem;">Changes will be applied to all assigned classrooms</p>
        </div>
    </div>

    <script>
        let elementCounter = 100; // Start high to avoid conflicts

        // Update page title when form title changes
        document.getElementById('formTitle').addEventListener('input', function() {
            const newTitle = this.value || '{{ $form->title }}';
            document.getElementById('pageTitle').innerHTML = `<i class="fas fa-edit me-2 text-primary"></i>Edit Form: ${newTitle}`;
        });

        function addInput() {
            const title = prompt('Enter label for text input:');
            if (!title || title.trim() === '') return;

            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';

            const div = document.createElement('div');
            div.className = 'form-element';
            div.innerHTML = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <input type="text" class="form-control" name="form_text_${elementCounter}" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}>
                <div class="element-controls">
                    <div class="required-toggle">
                        <input type="checkbox" class="required-checkbox" ${isRequired ? 'checked' : ''} onchange="toggleRequired(this)">
                        <span>Required field</span>
                    </div>
                </div>
            `;
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addTextarea() {
            const title = prompt('Enter label for textarea:');
            if (!title || title.trim() === '') return;

            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';

            const div = document.createElement('div');
            div.className = 'form-element';
            div.innerHTML = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <textarea class="form-control" name="form_textarea_${elementCounter}" rows="3" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}></textarea>
                <div class="element-controls">
                    <div class="required-toggle">
                        <input type="checkbox" class="required-checkbox" ${isRequired ? 'checked' : ''} onchange="toggleRequired(this)">
                        <span>Required field</span>
                    </div>
                </div>
            `;
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addRadio() {
            const title = prompt('Enter question for radio buttons:');
            if (!title || title.trim() === '') return;

            const options = prompt('Enter options separated by commas:');
            if (!options || options.trim() === '') return;

            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';
            const optionArray = options.split(',').map(opt => opt.trim());

            const div = document.createElement('div');
            div.className = 'form-element';
            let radioHtml = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label><br>
            `;

            optionArray.forEach((option, index) => {
                radioHtml += `
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="form_radio_${elementCounter}" value="${option}" id="radio_${elementCounter}_${index}" ${requiredAttr}>
                        <label class="form-check-label" for="radio_${elementCounter}_${index}">${option}</label>
                    </div>
                `;
            });

            radioHtml += `
                <div class="element-controls">
                    <div class="required-toggle">
                        <input type="checkbox" class="required-checkbox" ${isRequired ? 'checked' : ''} onchange="toggleRequired(this)">
                        <span>Required field</span>
                    </div>
                </div>
            `;
            div.innerHTML = radioHtml;
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addCheckbox() {
            const title = prompt('Enter question for checkboxes:');
            if (!title || title.trim() === '') return;

            const options = prompt('Enter options separated by commas:');
            if (!options || options.trim() === '') return;

            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';
            const optionArray = options.split(',').map(opt => opt.trim());

            const div = document.createElement('div');
            div.className = 'form-element';
            let checkboxHtml = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label><br>
            `;

            optionArray.forEach((option, index) => {
                checkboxHtml += `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="form_checkbox_${elementCounter}[]" value="${option}" id="checkbox_${elementCounter}_${index}" ${index === 0 ? requiredAttr : ''}>
                        <label class="form-check-label" for="checkbox_${elementCounter}_${index}">${option}</label>
                    </div>
                `;
            });

            checkboxHtml += `
                <div class="element-controls">
                    <div class="required-toggle">
                        <input type="checkbox" class="required-checkbox" ${isRequired ? 'checked' : ''} onchange="toggleRequired(this)">
                        <span>Required field</span>
                    </div>
                </div>
            `;
            div.innerHTML = checkboxHtml;
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addSelect() {
            const title = prompt('Enter label for select dropdown:');
            if (!title || title.trim() === '') return;

            const options = prompt('Enter options separated by commas:');
            if (!options || options.trim() === '') return;

            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';
            const optionArray = options.split(',').map(opt => opt.trim());

            const div = document.createElement('div');
            div.className = 'form-element';
            let selectHtml = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <select class="form-select" name="form_select_${elementCounter}" ${requiredAttr}>
                    <option value="">Choose ${title.toLowerCase()}</option>
            `;

            optionArray.forEach(option => {
                selectHtml += `<option value="${option}">${option}</option>`;
            });

            selectHtml += '</select>';
            selectHtml += `
                <div class="element-controls">
                    <div class="required-toggle">
                        <input type="checkbox" class="required-checkbox" ${isRequired ? 'checked' : ''} onchange="toggleRequired(this)">
                        <span>Required field</span>
                    </div>
                </div>
            `;
            div.innerHTML = selectHtml;
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addDate() {
            const title = prompt('Enter label for date input:');
            if (!title || title.trim() === '') return;

            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';

            const div = document.createElement('div');
            div.className = 'form-element';
            div.innerHTML = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <input type="date" class="form-control" name="form_date_${elementCounter}" ${requiredAttr}>
                <div class="element-controls">
                    <div class="required-toggle">
                        <input type="checkbox" class="required-checkbox" ${isRequired ? 'checked' : ''} onchange="toggleRequired(this)">
                        <span>Required field</span>
                    </div>
                </div>
            `;
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addTel() {
            const title = prompt('Enter label for phone input:');
            if (!title || title.trim() === '') return;

            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';

            const div = document.createElement('div');
            div.className = 'form-element';
            div.innerHTML = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <input type="tel" class="form-control" name="form_tel_${elementCounter}" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}>
                <div class="element-controls">
                    <div class="required-toggle">
                        <input type="checkbox" class="required-checkbox" ${isRequired ? 'checked' : ''} onchange="toggleRequired(this)">
                        <span>Required field</span>
                    </div>
                </div>
            `;
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addFile() {
            const title = prompt('Enter label for file input:');
            if (!title || title.trim() === '') return;

            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';

            const div = document.createElement('div');
            div.className = 'form-element';
            div.innerHTML = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <input type="file" class="form-control" name="form_file_${elementCounter}" ${requiredAttr}>
                <div class="element-controls">
                    <div class="required-toggle">
                        <input type="checkbox" class="required-checkbox" ${isRequired ? 'checked' : ''} onchange="toggleRequired(this)">
                        <span>Required field</span>
                    </div>
                </div>
            `;
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function updateForm() {
            const html = document.getElementById('formArea').innerHTML;
            const title = document.getElementById('formTitle').value;

            if (!title || title.trim() === '') {
                alert('Form title is required!');
                return;
            }

            fetch('{{ route("teacher.updateForm", $form->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    html_content: html,
                    title: title
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        console.log('Error response:', text);
                        throw new Error('Server error: ' + response.status);
                    });
                }
                return response.text().then(text => {
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        console.log('Response was:', text.substring(0, 200));
                        throw new Error('Invalid JSON response from server');
                    }
                });
            })
            .then(data => {
                alert('Form updated successfully!');
                const urlParams = new URLSearchParams(window.location.search);
                const classroomId = urlParams.get('classroom_id');
                if (classroomId) {
                    window.location.href = `/teacher/classroom/show/${classroomId}`;
                } else {
                    window.location.href = '{{ route("teacher.dashboard") }}';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating form: ' + error.message);
            });
        }

        function editTitle(button, event) {
            if (event) event.stopPropagation();
            
            const label = button.parentElement;
            const currentTitle = label.childNodes[0].textContent.replace(' *', '').trim();
            const newTitle = prompt('Edit title:', currentTitle);
            
            if (newTitle && newTitle.trim() !== '' && newTitle.trim() !== currentTitle) {
                const hasAsterisk = label.innerHTML.includes('<span class="text-danger">*</span>');
                const asterisk = hasAsterisk ? ' <span class="text-danger">*</span>' : '';
                label.innerHTML = `${newTitle}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button>`;
            }
        }

        function toggleRequired(checkbox) {
            const formElement = checkbox.closest('.form-element');
            const label = formElement.querySelector('.form-label');
            const inputs = formElement.querySelectorAll('input:not(.required-checkbox), textarea, select');
            
            if (checkbox.checked) {
                // Add required attribute and asterisk
                inputs.forEach(input => input.setAttribute('required', ''));
                if (!label.innerHTML.includes('<span class="text-danger">*</span>')) {
                    const editBtn = label.querySelector('.edit-title-btn');
                    const titleText = label.childNodes[0].textContent.trim();
                    label.innerHTML = `${titleText} <span class="text-danger">*</span>`;
                    if (editBtn) label.appendChild(editBtn);
                }
            } else {
                // Remove required attribute and asterisk
                inputs.forEach(input => input.removeAttribute('required'));
                if (label.innerHTML.includes('<span class="text-danger">*</span>')) {
                    const editBtn = label.querySelector('.edit-title-btn');
                    const titleText = label.childNodes[0].textContent.replace(' *', '').trim();
                    label.innerHTML = titleText;
                    if (editBtn) label.appendChild(editBtn);
                }
            }
        }

        // Add edit buttons and required toggles to existing form elements on page load
        document.addEventListener('DOMContentLoaded', function() {
            const existingElements = document.querySelectorAll('#formArea .form-element');
            existingElements.forEach(function(element) {
                const label = element.querySelector('.form-label');
                
                // Add edit button if it doesn't exist
                if (label && !label.querySelector('.edit-title-btn')) {
                    const editBtn = document.createElement('button');
                    editBtn.className = 'edit-title-btn';
                    editBtn.onclick = function(event) { editTitle(this, event); };
                    editBtn.title = 'Edit title';
                    editBtn.innerHTML = '<i class="fas fa-edit"></i>';
                    label.appendChild(editBtn);
                }
                
                // Add required toggle if it doesn't exist
                if (!element.querySelector('.element-controls')) {
                    const inputs = element.querySelectorAll('input:not(.required-checkbox), textarea, select');
                    const isRequired = inputs.length > 0 && inputs[0].hasAttribute('required');
                    
                    const controlsDiv = document.createElement('div');
                    controlsDiv.className = 'element-controls';
                    controlsDiv.innerHTML = `
                        <div class="required-toggle">
                            <input type="checkbox" class="required-checkbox" ${isRequired ? 'checked' : ''} onchange="toggleRequired(this)">
                            <span>Required field</span>
                        </div>
                    `;
                    element.appendChild(controlsDiv);
                }
            });
        });
    </script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
</body>
</html>
