<!DOCTYPE html>
<html>
<head>
    <title>{{ $submission->form->title ?? 'Form Submission' }} - {{ $submission->submitter_name }}</title>
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
            max-width: 1370px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header Section */
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
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
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            position: relative;
            z-index: 1;
            cursor: pointer;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-1px);
        }

        /* Submitter Info Section */
        .submitter-info {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            margin-bottom: 2rem;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            position: relative;
        }

        .submitter-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--success), #16a34a);
            border-radius: 16px 16px 0 0;
        }

        .submitter-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .submitter-profile {
            display: flex;
            align-items: center;
        }

        .submitter-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--success) 0%, #16a34a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            margin-right: 1.25rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .submitter-details h5 {
            color: var(--neutral-800);
            font-weight: 600;
            font-size: 1.25rem;
            margin: 0 0 0.25rem 0;
            line-height: 1.3;
        }

        .submitter-email {
            color: var(--neutral-500);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.25rem;
        }

        .submission-time {
            color: var(--neutral-400);
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .type-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .type-badge.teacher {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .type-badge.student {
            background: rgba(14, 165, 233, 0.1);
            color: var(--primary-blue);
        }

        .type-badge.guest {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        /* Content Cards */
        .content-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-100) 100%);
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid var(--neutral-200);
        }

        .card-title {
            font-weight: 600;
            font-size: 1.125rem;
            margin: 0;
            color: var(--neutral-800);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 1.75rem;
            background: white;
        }

        /* Response Content Styling */
        .response-content {
            background: var(--neutral-50);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--neutral-200);
            margin-top: 1rem;
        }

        .response-item {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--neutral-200);
        }

        .response-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .response-label {
            font-weight: 600;
            color: var(--neutral-800);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .response-value {
            color: var(--neutral-600);
            line-height: 1.6;
            font-size: 0.9375rem;
        }

        /* Meta Information */
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .meta-card {
            background: var(--neutral-50);
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid var(--neutral-200);
            text-align: center;
        }

        .meta-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            margin: 0 auto 0.75rem;
        }

        .meta-icon.time {
            background: rgba(14, 165, 233, 0.1);
            color: var(--primary-blue);
        }

        .meta-icon.date {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .meta-icon.ip {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .meta-value {
            font-weight: 600;
            color: var(--neutral-800);
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .meta-label {
            color: var(--neutral-500);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 500;
        }

        /* Form Input Styling */
        .form-control[readonly] {
            background-color: var(--neutral-50);
            border-color: var(--neutral-300);
            color: var(--neutral-700);
        }

        .form-check-input[disabled] {
            opacity: 1;
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        .form-check-label {
            color: var(--neutral-700);
            font-weight: 500;
        }

        /* File Display Styling */
        .file-info {
            background: var(--neutral-100);
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid var(--neutral-200);
        }

        .file-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .file-link {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
        }

        .file-link:hover {
            text-decoration: underline;
        }

        .file-size {
            color: var(--neutral-500);
            font-size: 0.875rem;
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

            .submitter-info {
                padding: 1.25rem;
            }

            .submitter-main {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .card-body {
                padding: 1.25rem;
            }

            .meta-grid {
                grid-template-columns: 1fr;
            }
        } uppercase;
            letter-spacing: 0.05em;
            font-weight: 500;
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

            .submitter-info {
                padding: 1.25rem;
            }

            .submitter-main {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .card-body {
                padding: 1.25rem;
            }

            .meta-grid {
                grid-template-columns: 1fr;
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
                    <h1 class="page-title">
                        <i class="fas fa-file-text me-2"></i>{{ $submission->form->title ?? 'Form Submission' }}
                    </h1>
                    <p class="page-subtitle">Submission Details</p>
                </div>
                <button onclick="history.back()" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </button>
            </div>
        </div>

        <!-- Submitter Information -->
        <div class="submitter-info">
            <div class="submitter-main">
                <div class="submitter-profile">
                    <div class="submitter-avatar">
                        {{ strtoupper(substr($submission->submitter_name, 0, 1)) }}
                    </div>
                    <div class="submitter-details">
                        <h5>{{ $submission->submitter_name }}</h5>
                        <div class="submitter-email">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $submission->submitter_email }}</span>
                        </div>
                        <div class="submission-time">
                            <i class="fas fa-clock"></i>
                            <span>{{ $submission->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                <div class="status-section">
                    <div class="type-badge {{ $submission->submitter_type }}">
                        <i class="fas fa-{{ $submission->submitter_type === 'teacher' ? 'chalkboard-teacher' : ($submission->submitter_type === 'student' ? 'user-graduate' : 'user') }} me-1"></i>
                        {{ ucfirst($submission->submitter_type) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Submission Details -->
        <div class="content-card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fas fa-clipboard-list"></i>
                    Form Responses
                </h4>
            </div>
            <div class="card-body">
                <!-- Meta Information Grid -->
                <div class="meta-grid">
                    <div class="meta-card">
                        <div class="meta-icon date">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="meta-value">{{ $submission->created_at->format('M d, Y') }}</div>
                        <div class="meta-label">Submission Date</div>
                    </div>
                    <div class="meta-card">
                        <div class="meta-icon time">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="meta-value">{{ $submission->created_at->format('H:i') }}</div>
                        <div class="meta-label">Time Submitted</div>
                    </div>

                </div>

                <!-- Response Content -->
                <div class="response-content">
                    @if(is_array($submission->form_responses) && count($submission->form_responses) > 0)
                        @foreach($submission->form_responses as $key => $value)
                            <div class="response-item">
                                <div class="response-label">
                                    {{ $key }}
                                </div>
                                <div class="response-value">
                                    @php
                                        $fieldType = 'text'; // default
                                        $fieldValue = '';

                                        if (is_array($value) && isset($value['original_name'])) {
                                            $fieldType = 'file';
                                            $fieldValue = $value;
                                        } elseif (is_array($value)) {
                                            $fieldType = 'checkbox';
                                            $fieldValue = $value;
                                        } elseif (in_array(strtolower($key), ['email', 'e-mail', 'mail'])) {
                                            $fieldType = 'email';
                                            $fieldValue = (string)$value;
                                        } elseif (in_array(strtolower($key), ['phone', 'tel', 'telephone', 'mobile'])) {
                                            $fieldType = 'tel';
                                            $fieldValue = (string)$value;
                                        } elseif (in_array(strtolower($key), ['password', 'pass'])) {
                                            $fieldType = 'password';
                                            $fieldValue = (string)$value;
                                        } elseif (in_array(strtolower($key), ['date', 'birthday', 'dob'])) {
                                            $fieldType = 'date';
                                            $fieldValue = (string)$value;
                                        } elseif (in_array(strtolower($key), ['time'])) {
                                            $fieldType = 'time';
                                            $fieldValue = (string)$value;
                                        } elseif (in_array(strtolower($key), ['url', 'website', 'link'])) {
                                            $fieldType = 'url';
                                            $fieldValue = (string)$value;
                                        } elseif (in_array(strtolower($key), ['number', 'age', 'quantity', 'amount'])) {
                                            $fieldType = 'number';
                                            $fieldValue = (string)$value;
                                        } elseif (strlen((string)$value) > 100) {
                                            $fieldType = 'textarea';
                                            $fieldValue = (string)$value;
                                        } else {
                                            $fieldValue = (string)$value;
                                        }
                                    @endphp

                                    @if($fieldType === 'file')
                                        <div class="file-info">
                                            <div class="file-item">
                                                <i class="fas fa-file me-2"></i>
                                                <a href="{{ route('form.file', $fieldValue['stored_name']) }}" target="_blank" class="file-link">
                                                    {{ $fieldValue['original_name'] }}
                                                </a>
                                                <span class="file-size">({{ number_format($fieldValue['size'] / 1024, 2) }} KB)</span>
                                            </div>
                                        </div>
                                    @elseif($fieldType === 'checkbox')
                                        @foreach($fieldValue as $option)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" checked disabled>
                                                <label class="form-check-label">
                                                    @php
                                                        $cleanOption = $option;
                                                        if (is_array($option) || is_object($option)) {
                                                            $cleanOption = json_encode($option);
                                                        } else {
                                                            $cleanOption = (string)$option;
                                                        }
                                                        // Remove brackets and quotes
                                                        $cleanOption = str_replace(['["', '"]', '"'], '', $cleanOption);
                                                    @endphp
                                                    {{ $cleanOption }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @elseif($fieldType === 'textarea')
                                        <textarea class="form-control" rows="4" readonly>{{ $fieldValue }}</textarea>
                                    @else
                                        <input type="{{ $fieldType }}" class="form-control" value="{{ $fieldValue }}" readonly>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2">No response data available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Technical Details -->
        @if($submission->user_agent)
        <div class="content-card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Technical Information
                </h4>
            </div>
            <div class="card-body">
                <div class="response-item">
                    <div class="response-label">User Agent</div>
                    <div class="response-value">{{ $submission->user_agent }}</div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
