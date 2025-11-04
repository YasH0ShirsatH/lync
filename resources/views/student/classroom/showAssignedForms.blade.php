<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $form->form->title }} - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        :root {
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --primary-700: #0369a1;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --success-50: #f0fdf4;
            --success-500: #22c55e;
            --warning-50: #fffbeb;
            --warning-500: #f59e0b;
            --danger-500: #ef4444;
            --white: #ffffff;
        }

        body {
            background: linear-gradient(135deg, var(--gray-50) 0%, #e0f2fe 100%);
            min-height: 100vh;
            color: var(--gray-800);
        }

        .container {
            max-width: 1350px;
        }

        .page-header {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 1rem;
        }

        .breadcrumb-item a {
            color: var(--primary-600);
            text-decoration: none;
        }

        .page-title {
            color: var(--gray-900);
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 1rem;
            margin: 0;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-submitted {
            background: var(--success-50);
            color: var(--success-500);
        }

        .status-pending {
            background: var(--warning-50);
            color: var(--warning-500);
        }

        .form-container {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .form-content {
            padding: 2rem;
        }

        .form-control, .form-select {
            border: 1px solid var(--gray-200);
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-500);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
            outline: none;
        }

        .form-control:disabled, .form-select:disabled {
            background: var(--gray-50);
            border-color: var(--gray-200);
            opacity: 0.8;
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .alert {
            border-radius: 0.75rem;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: var(--success-50);
            color: var(--success-500);
            border-left: 4px solid var(--success-500);
        }

        .alert-warning {
            background: var(--warning-50);
            color: var(--warning-500);
            border-left: 4px solid var(--warning-500);
        }

        .teacher-feedback {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 1rem;
            overflow: hidden;
            margin-top: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .feedback-header {
            background: linear-gradient(135deg, var(--success-500) 0%, #16a34a 100%);
            color: white;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .feedback-avatar {
            width: 2.5rem;
            height: 2.5rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feedback-body {
            padding: 2rem;
        }

        .score-section {
            background: var(--success-50);
            padding: 1.5rem;
            border-radius: 0.75rem;
            border: 1px solid #dcfce7;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .score-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .score-icon {
            width: 3rem;
            height: 3rem;
            background: var(--success-500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .score-badge {
            background: linear-gradient(135deg, var(--success-500) 0%, #16a34a 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-size: 1.125rem;
            font-weight: 600;
        }

        .comment-section {
            background: var(--gray-50);
            padding: 1.5rem;
            border-radius: 0.75rem;
            border-left: 4px solid var(--success-500);
        }

        .action-section {
            background: var(--gray-50);
            padding: 2rem;
            border-top: 1px solid var(--gray-200);
            text-align: center;
        }

        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.875rem 2rem;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
            color: white;
        }

        .btn-outline-secondary {
            border: 1px solid var(--gray-200);
            color: var(--gray-600);
            background: var(--white);
        }

        .btn-outline-secondary:hover {
            background: var(--gray-100);
            border-color: var(--gray-300);
            color: var(--gray-700);
        }

        .btn-secondary {
            background: var(--gray-500);
            color: white;
        }

        .remove-btn, button[onclick*="removeField"], .edit-title-btn {
            display: none !important;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="page-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:history.back()">Classroom</a></li>
                    <li class="breadcrumb-item active">{{ $form->form->title }}</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Form Submission</h1>
                    <p class="page-subtitle">Complete and submit your assignment</p>
                </div>
                <div class="status-badge {{ $isSubmitted ? 'status-submitted' : 'status-pending' }}">
                    <i class="fas {{ $isSubmitted ? 'fa-check-circle' : 'fa-clock' }}"></i>
                    {{ $isSubmitted ? 'Submitted' : 'Pending' }}
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <div class="form-header">
                        <h3 class="form-title">{{ $form->form->title }}</h3>
                    </div>

                    <div class="form-content">
                        @if($isSubmitted && $submission)
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Submission Complete</strong> - Your response has been recorded successfully.
                            </div>

                            @if($formUpdatedAfterSubmission)
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Form Updated</strong> - This form was modified after your submission. Your original response is preserved below.
                                </div>
                            @endif

                            <div class="submitted-responses">
                                {!! $submission->responses !!}
                            </div>

                            @if($submission->rating !== null || $submission->comment)
                                <div class="teacher-feedback">
                                    <div class="feedback-header">
                                        <div class="feedback-avatar">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">Teacher Feedback</h5>
                                            <small style="opacity: 0.9;">Your submission has been reviewed</small>
                                        </div>
                                    </div>
                                    <div class="feedback-body">
                                        @if($submission->rating !== null)
                                            @php
                                                $totalMarks = '';
                                                if ($submission->comment && str_contains($submission->comment, '|')) {
                                                    $parts = explode('|', $submission->comment, 2);
                                                    $marksData = $parts[0];
                                                    if (str_contains($marksData, '/')) {
                                                        $marksParts = explode('/', $marksData);
                                                        $totalMarks = $marksParts[1] ?? '';
                                                    }
                                                }
                                            @endphp
                                            <div class="score-section">
                                                <div class="score-info">
                                                    <div class="score-icon">
                                                        <i class="fas fa-trophy"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1" style="color: var(--success-500); font-weight: 600;">Your Score</h6>
                                                        <p class="mb-0 text-muted" style="font-size: 0.875rem;">Marks obtained</p>
                                                    </div>
                                                </div>
                                                <div class="score-badge">
                                                    {{ $submission->rating }}{{ $totalMarks ? '/' . $totalMarks : '' }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($submission->comment)
                                            @php
                                                $teacherComment = $submission->comment;
                                                if (str_contains($submission->comment, '|')) {
                                                    $parts = explode('|', $submission->comment, 2);
                                                    $teacherComment = $parts[1] ?? '';
                                                } elseif (str_contains($submission->comment, '/')) {
                                                    $teacherComment = '';
                                                }
                                            @endphp
                                            @if($teacherComment)
                                                <div class="comment-section">
                                                    <div class="d-flex align-items-start gap-3">
                                                        <div style="width: 2.25rem; height: 2.25rem; background: var(--success-500); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                                                            <i class="fas fa-comment-alt" style="font-size: 0.875rem;"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-2" style="color: var(--gray-900); font-weight: 600;">Teacher's Comments</h6>
                                                            <p class="mb-0" style="color: var(--gray-600); line-height: 1.6; font-style: italic;">"{{ $teacherComment }}"</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endif
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

    const requiredFields = form.querySelectorAll('input[required], textarea[required], select[required]');
    let hasErrors = false;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            hasErrors = true;
            field.style.borderColor = 'var(--danger-500)';
            field.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
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
                form.querySelectorAll('input, textarea, select').forEach(field => {
                    field.disabled = false;
                });
                alert('Error: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
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