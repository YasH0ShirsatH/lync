<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Form - {{ $form->title }}</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .card {
            background: #212529c4;
            border: none;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .card-title {
            color: white;
            font-weight: 600;
        }

        .btn {
            border-radius: 25px;
            font-weight: 500;
            padding: 12px 20px;
            border: 2px solid;
            transition: all 0.3s ease;
        }

        .btn-outline-primary {
            color: #0d6efd;
            border-color: #0d6efd;
            background: white;
        }

        .btn-outline-primary:hover {
            background: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .btn-outline-success {
            color: #198754;
            border-color: #198754;
            background: white;
        }

        .btn-outline-success:hover {
            background: #198754;
            border-color: #198754;
            color: white;
        }

        .btn-outline-warning {
            color: #ffc107;
            border-color: #ffc107;
            background: white;
        }

        .btn-outline-warning:hover {
            background: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .btn-outline-info {
            color: #0dcaf0;
            border-color: #0dcaf0;
            background: white;
        }

        .btn-outline-info:hover {
            background: #0dcaf0;
            border-color: #0dcaf0;
            color: white;
        }

        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
            background: white;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        .btn-outline-dark {
            color: #212529;
            border-color: #212529;
            background: white;
        }

        .btn-outline-dark:hover {
            background: #212529;
            border-color: #212529;
            color: white;
        }

        .btn-success {
            background: #198754;
            border-color: #198754;
            border-radius: 25px;
            padding: 15px 30px;
            font-weight: 600;
        }

        #formArea {
            border: 2px dashed #343a40;
            border-radius: 25px;
            padding: 40px;
            min-height: 250px;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
        }

        .form-element {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .form-control, .form-select {
            border-radius: 15px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
        }

        .remove-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 14px;
            font-weight: bold;
        }

        .remove-btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-4" id="pageTitle"><i class="fas fa-edit me-2 text-primary"></i>Edit Form: {{ $form->title }}</h2>
                    <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-dark btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Back
                    </a>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Form Title</label>
                    <input type="text" id="formTitle" class="form-control" value="{{ $form->title }}" placeholder="Enter form title">
                </div>
                
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Add Form Elements</h5>
                        <div class="row g-2">
                            <div class="col-md-2">
                                <button class="btn btn-outline-primary w-100" onclick="addInput()"><i class="fas fa-font me-1"></i>Text Input</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-success w-100" onclick="addTextarea()"><i class="fas fa-align-left me-1"></i>Textarea</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-warning w-100" onclick="addRadio()"><i class="fas fa-dot-circle me-1"></i>Radio</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-info w-100" onclick="addCheckbox()"><i class="fas fa-check-square me-1"></i>Checkbox</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-secondary w-100" onclick="addSelect()"><i class="fas fa-list me-1"></i>Select</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-dark w-100" onclick="addDate()"><i class="fas fa-calendar me-1"></i>Date</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-primary w-100" onclick="addTel()"><i class="fas fa-phone me-1"></i>Phone</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-success w-100" onclick="addFile()"><i class="fas fa-file me-1"></i>File</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="formArea" class="mb-4">
                    {!! $form->html_content !!}
                </div>

                <button class="btn btn-success btn-lg" onclick="updateForm()"><i class="fas fa-save me-2"></i>Update Form</button>
            </div>
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <input type="text" class="form-control" name="form_text_${elementCounter}" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}>
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <textarea class="form-control" name="form_textarea_${elementCounter}" rows="3" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}></textarea>
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
                <label class="form-label fw-bold">${title}${asterisk}</label><br>
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
                <label class="form-label fw-bold">${title}${asterisk}</label><br>
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <select class="form-select" name="form_select_${elementCounter}" ${requiredAttr}>
                    <option value="">Choose ${title.toLowerCase()}</option>
            `;

            optionArray.forEach(option => {
                selectHtml += `<option value="${option}">${option}</option>`;
            });

            selectHtml += '</select>';
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <input type="date" class="form-control" name="form_date_${elementCounter}" ${requiredAttr}>
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <input type="tel" class="form-control" name="form_tel_${elementCounter}" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}>
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <input type="file" class="form-control" name="form_file_${elementCounter}" ${requiredAttr}>
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
    </script>
</body>
</html>
