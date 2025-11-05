<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Builder - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

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
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15);
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

        /* Classroom Selection */
        .classroom-section {
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
            background: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);
        }

        .element-btn i {
            font-size: 1.125rem;
        }

        /* Form Canvas */
        .form-canvas {
            background: white;
            border-radius: 16px;
            border: 2px dashed var(--neutral-300);
            min-height: 400px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            transition: all 0.2s ease;
        }

        .form-canvas.has-elements {
            border-style: solid;
            border-color: var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .canvas-placeholder {
            text-align: center;
            color: var(--neutral-400);
            padding: 3rem 1rem;
        }

        .canvas-placeholder-icon {
            width: 80px;
            height: 80px;
            background: var(--neutral-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--neutral-400);
            font-size: 2rem;
        }

        .canvas-placeholder h4 {
            color: var(--neutral-600);
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .canvas-placeholder p {
            color: var(--neutral-500);
            margin: 0;
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
            border-color: var(--primary-blue);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
        }

        .form-control, .form-select {
            border: 1px solid var(--neutral-300);
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
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
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
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
            background: var(--primary-blue);
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
            background: var(--primary-blue-dark);
            transform: scale(1.1);
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
            background: var(--success);
            border-color: var(--success);
            color: white;
            border-radius: 8px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .btn-save:hover {
            background: #059669;
            border-color: #059669;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        /* Success Alert */
        #successAlert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            background: linear-gradient(135deg, var(--success) 0%, #16a34a 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 500;
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.2);
            animation: slideInRight 0.5s ease;
            min-width: 320px;
            padding: 1rem 1.25rem;
        }

        #successAlert.fade-out {
            animation: slideOutRight 0.5s ease;
        }

        /* Bootstrap Select Overrides */
        .bootstrap-select .dropdown-toggle {
            border: 1px solid var(--neutral-300);
            border-radius: 8px;
            padding: 0.75rem;
        }

        .bootstrap-select .dropdown-toggle:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #92400e;
            border-left: 4px solid var(--warning);
        }

        /* Animations */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
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

            .classroom-section,
            .elements-toolbar,
            .save-section {
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <!-- Success Alert -->
    <div id="successAlert" class="alert" style="display: none;">
        <i class="fas fa-check-circle me-2"></i>
        <span id="successMessage"></span>
    </div>

    <div class="container py-4">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-hammer me-2"></i>Form Builder
                    </h1>
                    <p class="page-subtitle">Create interactive forms for your classrooms</p>
                </div>
                <a href="{{ route('teacher.dashboard') }}" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Classroom Selection -->
        <div class="classroom-section">
            <h3 class="section-title">
                <i class="fas fa-school"></i>
                Select Target Classrooms
            </h3>
            @if($classrooms->count() > 0)
                <select name="classroom[]" id="classroom" class="selectpicker form-control" multiple data-live-search="true" title="Choose classrooms to assign this form...">
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endforeach
                </select>
            @else
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    No classrooms found. <a href="{{ route('teacher.classroom.setup') }}" class="alert-link">Create a classroom first</a>.
                </div>
            @endif
        </div>

        <!-- Form Elements Toolbar -->
        <div class="elements-toolbar">
            <h3 class="section-title">
                <i class="fas fa-tools"></i>
                Form Elements
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
            <div class="canvas-placeholder">
                <div class="canvas-placeholder-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <h4>Start Building Your Form</h4>
                <p>Click on the elements above to add them to your form. You can drag and rearrange them as needed.</p>
            </div>
        </div>

        <!-- Save Section -->
        <div class="save-section">
            <button class="btn btn-save" onclick="saveForm()">
                <i class="fas fa-save me-2"></i>Save & Deploy Form
            </button>
            <p class="mt-2 mb-0 text-muted" style="font-size: 0.875rem;">Your form will be automatically assigned to the selected classrooms</p>
        </div>
    </div>

    <script>
        let elementCounter = 1;

        function addInput() {
            const title = prompt('Enter label for text input:');
            if (!title || title.trim() === '') {
                return;
            }
            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';

            const div = document.createElement('div');
            div.className = 'form-element';
            div.innerHTML = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <input type="text" class="form-control" name="form_text_${elementCounter}" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}>
            `;
            updateFormCanvas();
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function updateFormCanvas() {
            const formArea = document.getElementById('formArea');
            const placeholder = formArea.querySelector('.canvas-placeholder');
            if (placeholder) {
                placeholder.remove();
                formArea.classList.add('has-elements');
            }
        }

        function addTextarea() {
            const title = prompt('Enter label for textarea:');
            if (!title || title.trim() === '') {
                return;
            }
            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';

            const div = document.createElement('div');
            div.className = 'form-element';
            div.innerHTML = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <textarea class="form-control" style="resize:none" name="form_textarea_${elementCounter}" rows="3" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}></textarea>
            `;
            updateFormCanvas();
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addRadio() {
            const title = prompt('Enter question for radio buttons:');
            if (!title || title.trim() === '') {
                return;
            }
            const options = prompt('Enter options separated by commas:');
            if (!options || options.trim() === '') {
                return;
            }
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

            div.innerHTML = radioHtml;
            updateFormCanvas();
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addCheckbox() {
            const title = prompt('Enter question for checkboxes:');
            if (!title || title.trim() === '') {
                return;
            }
            const options = prompt('Enter options separated by commas:');
            if (!options || options.trim() === '') {
                return;
            }
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

            div.innerHTML = checkboxHtml;
            updateFormCanvas();
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addSelect() {
            const title = prompt('Enter label for select dropdown:');
            if (!title || title.trim() === '') {
                return;
            }
            const options = prompt('Enter options separated by commas:');
            if (!options || options.trim() === '') {
                return;
            }
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
            div.innerHTML = selectHtml;
            updateFormCanvas();
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addDate() {
            const title = prompt('Enter label for date input:');
            if (!title || title.trim() === '') {
                return;
            }
            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';

            const div = document.createElement('div');
            div.className = 'form-element';
            div.innerHTML = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <input type="date" class="form-control" name="form_date_${elementCounter}" ${requiredAttr}>
            `;
            updateFormCanvas();
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addTel() {
            const title = prompt('Enter label for phone input:');
            if (!title || title.trim() === '') {
                return;
            }
            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';

            const div = document.createElement('div');
            div.className = 'form-element';
            div.innerHTML = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <input type="tel" class="form-control" name="form_tel_${elementCounter}" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}>
            `;
            updateFormCanvas();
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function addFile() {
            const title = prompt('Enter label for file input:');
            if (!title || title.trim() === '') {
                return;
            }
            const isRequired = confirm('Is this field required?');
            const requiredAttr = isRequired ? 'required' : '';
            const asterisk = isRequired ? ' <span class="text-danger">*</span>' : '';

            const div = document.createElement('div');
            div.className = 'form-element';
            div.innerHTML = `
                <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                <label class="form-label">${title}${asterisk}<button class="edit-title-btn" onclick="editTitle(this, event)" title="Edit title"><i class="fas fa-edit"></i></button></label>
                <input type="file" class="form-control" name="form_file_${elementCounter}" ${requiredAttr}>
            `;
            updateFormCanvas();
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
        }

        function saveForm() {
            const html = document.getElementById('formArea').innerHTML;
            const classrooms = $('#classroom').val(); // Get array of selected values

            if (!classrooms || classrooms.length === 0) {
                alert('Please select at least one classroom!');
                return;
            }
            const title = prompt('Enter form title:');
            if (!title || title.trim() === '') {
                alert('Form title is required!');
                return;
            }

            fetch('{{ route("form.save") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    title: title,
                    html_content: html,
                    classroom: classrooms // Send array of classroom IDs
                })
            })
            .then(res => {
                console.log('Response status:', res.status);
                console.log('Response headers:', res.headers);

                if (!res.ok) {
                    return res.text().then(text => {
                        console.log('Error response body:', text);
                        throw new Error('Server error: ' + res.status + ' - ' + text.substring(0, 100));
                    });
                }

                return res.text().then(text => {
                    console.log('Response body:', text);
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        console.error('JSON parse error:', e);
                        console.error('Response was:', text.substring(0, 200));
                        throw new Error('Invalid JSON response from server');
                    }
                });
            })
            .then(data => {
                // Show success message
                const alert = document.getElementById('successAlert');
                document.getElementById('successMessage').textContent = data.message;
                alert.style.display = 'block';

                // Auto-hide after 3 seconds
                setTimeout(() => {
                    alert.classList.add('fade-out');
                    setTimeout(() => {
                        alert.style.display = 'none';
                        alert.classList.remove('fade-out');
                    }, 500);
                }, 3000);

                // Clear the form area and restore placeholder
                const formArea = document.getElementById('formArea');
                formArea.innerHTML = `
                    <div class="canvas-placeholder">
                        <div class="canvas-placeholder-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h4>Start Building Your Form</h4>
                        <p>Click on the elements above to add them to your form. You can drag and rearrange them as needed.</p>
                    </div>
                `;
                formArea.classList.remove('has-elements');

                // Reset counter and multiselect
                elementCounter = 1;
                $('#classroom').selectpicker('deselectAll');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving form: ' + error.message);
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

        // Initialize Bootstrap Select
        $(document).ready(function() {
            $('.selectpicker').selectpicker();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
</body>
</html>
