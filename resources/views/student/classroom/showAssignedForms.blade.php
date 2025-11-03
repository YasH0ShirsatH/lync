<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $form->form->title }} - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        .form-preview-card {
            background: rgba(52, 58, 64, 0.95);
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
        }
        .form-preview-card .card-header {
            background: transparent !important;
            border-radius: 25px 25px 0 0 !important;
            padding: 25px;
            border: none;
        }
        .form-preview-card h4 {
            color: white !important;
            font-size: 1.5rem;
            font-weight: 700;
        }
        .form-preview-card small {
            color: rgba(255,255,255,0.7) !important;
        }
        .form-preview-card small i {
            color: #0d6efd !important;
        }
        .btn {
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-outline-dark {
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            backdrop-filter: blur(10px);
        }
        .btn-outline-dark:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.5);
            color: white;
            transform: translateY(-2px);
        }
        .btn-success {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(25, 135, 84, 0.4);
        }
        .awesome-form {
            background: white;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .form-header {
            background: linear-gradient(135deg, #212529 0%, #343a40 100%);
            padding: 30px;
            text-align: center;
            position: relative;
        }
        .form-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: white;
        }
        .form-header h2 {
            color: white;
            font-weight: 700;
            font-size: 2.2rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .form-header p {
            color: rgba(255,255,255,0.8);
            margin: 10px 0 0 0;
            font-size: 1.1rem;
        }
        .form-body {
            padding: 40px;
        }
        .submit-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 30px;
            text-align: center;
            border-radius: 0 0 25px 25px;
        }
    </style>
</head>
<body>
   @include('layouts.navbar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 form-preview-card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1 fw-bold">Form Assignment</h4>
                                <small>
                                    <i class="fas fa-clipboard-list me-1"></i>{{ $isSubmitted ? 'View Mode' : 'Student Mode' }}
                                    <span class="mx-2">•</span>
                                    {{ $isSubmitted ? 'Submitted Response' : 'Complete and Submit' }}
                                </small>
                            </div>
                            <a href="javascript:history.back()" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="awesome-form">
                            <div class="form-header">
                                <h2>{{ $form->form->title }}</h2>
                                <p>{{ $isSubmitted ? 'Your submitted response is shown below' : 'Please fill out all required fields and submit your response' }}</p>
                            </div>
                            <div class="form-body">
                                @if($isSubmitted && $submission)
                                    <div class="submitted-responses">
                                        {!! $submission->responses !!}
                                    </div>
                                @else
                                    <form id="studentForm">
                                        {!! $form->form->html_content !!}
                                    </form>
                                @endif
                            </div>
                            <div class="submit-section">
                                @if($isSubmitted)
                                    <div class="alert alert-success mb-3">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Form has been submitted successfully!
                                    </div>
                                    @if($formUpdatedAfterSubmission)
                                        <div class="alert alert-warning mb-3">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <strong>Notice:</strong> This form was updated after your submission. Your original response is preserved below.
                                        </div>
                                    @endif
                                    <button type="button" class="btn btn-secondary btn-lg" disabled>
                                        <i class="fas fa-check me-2"></i>Already Submitted
                                    </button>
                                @else
                                    <button type="button" class="btn btn-success btn-lg me-3" onclick="submitForm()">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Form
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-lg" onclick="resetForm()">
                                        <i class="fas fa-undo me-2"></i>Reset
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitForm() {
            if (confirm('Are you sure you want to submit this form? You cannot edit it after submission.')) {
                const form = document.getElementById('studentForm');

                // Get all form data
                const formData = new FormData(form);
                let responseData = {};

                // Collect responses
                for (let [key, value] of formData.entries()) {
                    if (responseData[key]) {
                        if (Array.isArray(responseData[key])) {
                            responseData[key].push(value);
                        } else {
                            responseData[key] = [responseData[key], value];
                        }
                    } else {
                        responseData[key] = value;
                    }
                }

                // Create HTML with filled values
                const formClone = form.cloneNode(true);
                const inputs = formClone.querySelectorAll('input, textarea, select');

                inputs.forEach(input => {
                    if (input.type === 'text' || input.type === 'email' || input.type === 'number') {
                        input.setAttribute('value', input.value);
                    } else if (input.type === 'checkbox' || input.type === 'radio') {
                        if (input.checked) {
                            input.setAttribute('checked', 'checked');
                        }
                    } else if (input.tagName === 'TEXTAREA') {
                        input.textContent = input.value;
                    } else if (input.tagName === 'SELECT') {
                        const options = input.querySelectorAll('option');
                        options.forEach(option => {
                            if (option.value === input.value) {
                                option.setAttribute('selected', 'selected');
                            }
                        });
                    }
                });

                fetch('/student/submit-form', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        form_id: {{ $form->form_id }},
                        responses: formClone.innerHTML
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert('An error occurred. Please try again.');
                });
            }
        }

        function resetForm() {
            if (confirm('Are you sure you want to reset all fields?')) {
                document.getElementById('studentForm').reset();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Hide remove buttons
            const removeButtons = document.querySelectorAll('.remove-btn');
            removeButtons.forEach(btn => {
                btn.style.display = 'none';
            });

            // Disable inputs if submitted
            @if($isSubmitted)
                const inputs = document.querySelectorAll('input, textarea, select');
                inputs.forEach(input => {
                    input.disabled = true;
                });
            @endif
        });
    </script>
</body>
</html>
