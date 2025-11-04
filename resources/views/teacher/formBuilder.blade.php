<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Builder - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .container {
            max-width: 1200px;
        }

        h2 {
            color: #212529;
            font-weight: 700;
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

        .text-center.text-muted {
            color: #6c757d !important;
        }

        .text-center.text-muted i {
            color: #343a40;
        }

        #successAlert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(25,135,84,0.3);
            backdrop-filter: blur(10px);
            animation: slideInRight 0.5s ease;
            min-width: 300px;
        }

        #successAlert.fade-out {
            animation: slideOutRight 0.5s ease;
        }

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
    </style>
</head>
<body>
   @include('layouts.navbar')

        <div id="successAlert" class="alert text-center p-3" style="display: none;">
            <i class="fas fa-check-circle me-2"></i>
            <span id="successMessage"></span>
        </div>

    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-4"><i class="fas fa-wpforms me-2 text-primary"></i>Form Builder</h2>
                    <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-dark btn-sm">
                                                    <i class="fas fa-arrow-left me-1"></i>Back
                                                </a>
                    </div>

                <div>
                    <h4>Enter Classroom </h4>
                    @if($classrooms->count() > 0)



                        <select name="classroom[]" id="classroom" class="selectpicker form-control mb-4" multiple data-live-search="true" title="--- SELECT CLASSROOMS ---">
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
                <div class="text-center text-muted">
                                        <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                        <p>Click buttons above to add form elements</p>
                                    </div>
                <div id="formArea" class="mb-4">

                </div>

                <button class="btn btn-success btn-lg" onclick="saveForm()"><i class="fas fa-save me-2"></i>Save Form</button>
            </div>
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <input type="text" class="form-control"  name="form_text_${elementCounter}" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr} >
            `;
            document.getElementById('formArea').appendChild(div);
            elementCounter++;
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <textarea class="form-control" style="resize:none" name="form_textarea_${elementCounter}" rows="3" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}></textarea>
            `;
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <input type="date" class="form-control" name="form_date_${elementCounter}" ${requiredAttr}>
            `;
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <input type="tel" class="form-control" name="form_tel_${elementCounter}" placeholder="Enter ${title.toLowerCase()}" ${requiredAttr}>
            `;
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
                <label class="form-label fw-bold">${title}${asterisk}</label>
                <input type="file" class="form-control" name="form_file_${elementCounter}" ${requiredAttr}>
            `;
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

                // Clear the form area
                document.getElementById('formArea').innerHTML = ``;

                // Reset counter and multiselect
                elementCounter = 1;
                $('#classroom').selectpicker('deselectAll');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving form: ' + error.message);
            });
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
