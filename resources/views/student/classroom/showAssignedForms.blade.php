<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $form->form->title }} - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header-section {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .form-title-bar {
            background: linear-gradient(135deg, #495057 0%, #6c757d 100%);
            color: white;
            padding: 1.5rem 2rem;
            border-bottom: 3px solid #007bff;
        }

        .form-content {
            padding: 2.5rem;
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        }

        .form-control:disabled, .form-select:disabled {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            opacity: 0.8;
        }

        .form-check-input:disabled {
            opacity: 0.6;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.75rem 2rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            border-color: #6c757d;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-submitted {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .action-section {
            background: #f8f9fa;
            padding: 2rem;
            border-top: 1px solid #e9ecef;
            text-align: center;
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.5rem;
        }

        .remove-btn {
            display: none !important;
        }

        button[onclick*="removeField"] {
            display: none !important;
        }

        .breadcrumb-nav {
            background: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }

        .breadcrumb-item a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: white;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="header-section">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:history.back()">Classroom</a></li>
                    <li class="breadcrumb-item active">{{ $form->form->title }}</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-2">Form Submission</h1>
                    <p class="mb-0 opacity-75">Complete and submit your assignment</p>
                </div>
                <div class="status-badge {{ $isSubmitted ? 'status-submitted' : 'status-pending' }}">
                    <i class="fas {{ $isSubmitted ? 'fa-check-circle' : 'fa-clock' }} me-2"></i>
                    {{ $isSubmitted ? 'Submitted' : 'Pending' }}
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <div class="form-title-bar">
                        <h3 class="mb-0">{{ $form->form->title }}</h3>
                    </div>

                    <div class="form-content">
                        @if($isSubmitted && $submission)
                            <div class="alert alert-success mb-4">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Submission Complete</strong> - Your response has been recorded successfully.
                            </div>

                            @if($formUpdatedAfterSubmission)
                                <div class="alert alert-warning mb-4">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Form Updated</strong> - This form was modified after your submission. Your original response is preserved below.
                                </div>
                            @endif

                            <div class="submitted-responses">
                                {!! $submission->responses !!}
                            </div>
                        @else
                            <form id="studentForm">
                                {!! $form->form->html_content !!}
                            </form>
                        @endif
                    </div>

                    <div class="action-section">
                        @if($isSubmitted)
                            <button type="button" class="btn btn-secondary btn-lg" disabled>
                                <i class="fas fa-check me-2"></i>Form Submitted
                            </button>
                        @else
                            <button type="button" class="btn btn-primary btn-lg me-3" onclick="submitForm()">
                                <i class="fas fa-paper-plane me-2"></i>Submit Form
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-lg" onclick="resetForm()">
                                <i class="fas fa-undo me-2"></i>Reset Form
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
function submitForm() {
    const form = document.getElementById('studentForm');

    // Validate required fields
    const requiredFields = form.querySelectorAll('input[required], textarea[required], select[required]');
    let hasErrors = false;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            hasErrors = true;
            field.style.borderColor = '#dc3545';
            field.style.boxShadow = '0 0 0 0.2rem rgba(220, 53, 69, 0.25)';
        } else {
            field.style.borderColor = '';
            field.style.boxShadow = '';
        }
    });

    if (hasErrors) {
        alert('Please fill in all required fields before submitting.');
        return;
    }

    if (confirm('Are you sure you want to submit this form? You cannot edit it after submission.')) {
        // Disable all form fields during submission
        form.querySelectorAll('input, textarea, select').forEach(field => {
            field.disabled = true;
        });

        const formClone = form.cloneNode(true);
        const inputs = formClone.querySelectorAll('input, textarea, select');

        inputs.forEach(input => {
            if (input.type === 'text' || input.type === 'email' || input.type === 'number' || input.type === 'tel') {
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
                    if (option.selected) {
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
                classroom_id: {{ $form->classroom_id }},
                form_id: {{ $form->form_id }},
                responses: formClone.innerHTML,
                form_version: '{{ $form->form->updated_at }}'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                // Re-enable fields if submission failed
                form.querySelectorAll('input, textarea, select').forEach(field => {
                    field.disabled = false;
                });
                alert('Error: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            // Re-enable fields if submission failed
            form.querySelectorAll('input, textarea, select').forEach(field => {
                field.disabled = false;
            });
            console.error('Error:', error);
            alert('Error submitting form. Please try again.');
        });
    }
}

function resetForm() {
    if (confirm('Are you sure you want to reset the form? All entered data will be lost.')) {
        document.getElementById('studentForm').reset();
        const form = document.getElementById('studentForm');
        form.querySelectorAll('input, textarea, select').forEach(field => {
            field.style.borderColor = '';
            field.style.boxShadow = '';
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.remove-btn, button[onclick*="removeField"]').forEach(btn => {
        btn.style.display = 'none';
    });
});
</script>
@include('javascript.js')

</body>
</html>
