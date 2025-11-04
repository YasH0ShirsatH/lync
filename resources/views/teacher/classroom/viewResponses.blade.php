<!DOCTYPE html>
<html>
<head>
    <title>Form Responses - {{ $form->title }}</title>
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

        /* Enhanced Stats Section */
        .stats-section {
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
        }

        .stat-icon.responses {
            background: rgba(14, 165, 233, 0.1);
            color: var(--primary-blue);
        }

        .stat-icon.students {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .stat-icon.latest {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .stat-number {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--neutral-800);
            margin: 0;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--neutral-500);
            margin: 0.25rem 0 0 0;
            font-weight: 500;
        }

        /* Filters and Actions */
        .controls-bar {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .search-box {
            position: relative;
            max-width: 300px;
        }

        .search-box input {
            padding-left: 2.5rem;
            border: 1px solid var(--neutral-300);
            border-radius: 8px;
            font-size: 0.875rem;
        }

        .search-box i {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--neutral-400);
        }

        /* Response Cards */
        .responses-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .response-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            overflow: hidden;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .response-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            border-color: var(--primary-blue);
        }

        .response-header {
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-100) 100%);
            padding: 1.25rem;
            border-bottom: 1px solid var(--neutral-200);
        }

        .student-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .student-main {
            display: flex;
            align-items: center;
        }

        .student-avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 1rem;
            font-size: 1.125rem;
        }

        .student-details h6 {
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
            color: var(--neutral-800);
        }

        .student-email {
            font-size: 0.875rem;
            color: var(--neutral-500);
            margin: 0.25rem 0 0 0;
        }

        .submission-meta {
            text-align: right;
        }

        .submission-time {
            font-size: 0.875rem;
            color: var(--neutral-500);
            margin: 0;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .status-badge.graded {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-badge.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .response-body {
            padding: 1.5rem;
            background: white;
        }

        .response-preview {
            color: var(--neutral-600);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .response-preview h1, .response-preview h2, .response-preview h3,
        .response-preview h4, .response-preview h5, .response-preview h6 {
            color: var(--neutral-800);
            margin-bottom: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
        }

        .response-preview p {
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
        }

        .response-preview ul, .response-preview ol {
            padding-left: 1.25rem;
            font-size: 0.875rem;
        }

        .response-preview li {
            margin-bottom: 0.25rem;
        }

        /* Teacher Remarks Section */
        .remarks-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--neutral-200);
        }

        .remarks-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .remarks-header h6 {
            margin: 0;
            font-weight: 600;
            color: var(--neutral-700);
            font-size: 0.875rem;
        }

        .remarks-form {
            background: var(--neutral-50);
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid var(--neutral-200);
        }

        .marks-input-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .marks-input {
            width: 70px;
            text-align: center;
            border: 1px solid var(--neutral-300);
            border-radius: 6px;
            padding: 0.375rem;
            font-size: 0.875rem;
        }

        .form-control-sm {
            border: 1px solid var(--neutral-300);
            border-radius: 6px;
            font-size: 0.875rem;
        }

        .form-control-sm:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.1);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 12px;
            border: 1px solid var(--neutral-200);
        }

        .empty-state-icon {
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

        .empty-state h4 {
            color: var(--neutral-700);
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .empty-state p {
            color: var(--neutral-500);
            margin: 0;
        }

        /* Buttons */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        .btn-primary:hover {
            background: var(--primary-blue-dark);
            border-color: var(--primary-blue-dark);
            transform: translateY(-1px);
        }

        .btn-warning {
            background: var(--warning);
            border-color: var(--warning);
        }

        .btn-success {
            background: var(--success);
            border-color: var(--success);
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

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .response-body {
                padding: 1rem;
            }

            .student-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .submission-meta {
                text-align: left;
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
                        <i class="fas fa-chart-line me-2"></i>{{ $form->title }}
                    </h1>
                    <p class="page-subtitle">{{ $classroom->name }} • Form Responses</p>
                </div>
                <a href="{{ route('teacher.classroom.show', $classroom->id) }}" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back to Classroom
                </a>
            </div>
        </div>

        <!-- Enhanced Stats Section -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon responses">
                            <i class="fas fa-file-text"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $submissions ? $submissions->count() : 0 }}</div>
                    <div class="stat-label">Total Responses</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon students">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $submissions ? $submissions->unique('student_id')->count() : 0 }}</div>
                    <div class="stat-label">Students Responded</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon latest">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $submissions ? $submissions->whereNotNull('rating')->count() : 0 }}</div>
                    <div class="stat-label">Graded Responses</div>
                </div>
            </div>

            <!-- Controls Bar -->
            <div class="controls-bar">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search by student name..." id="searchInput">
                    </div>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" style="width: auto;" id="statusFilter">
                            <option value="all">All Responses</option>
                            <option value="graded">Graded Only</option>
                            <option value="pending">Pending Review</option>
                        </select>
                        <button class="btn btn-outline-primary btn-sm" onclick="exportResponses()">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responses Grid -->
        <div class="responses-grid">
            @forelse($submissions as $submission)
                <div class="response-card" onclick="window.location.href='{{ route('teacher.viewSubmission', $submission->id) }}'">
                    <div class="response-header">
                        <div class="student-info">
                            <div class="student-main">
                                <div class="student-avatar">
                                    {{ strtoupper(substr($submission->student->name, 0, 1)) }}
                                </div>
                                <div class="student-details">
                                    <h6>{{ $submission->student->name }}</h6>
                                    <div class="student-email">{{ $submission->student->email }}</div>
                                </div>
                            </div>
                            <div class="submission-meta">
                                <div class="submission-time">
                                    <i class="fas fa-clock me-1"></i>{{ $submission->created_at->diffForHumans() }}
                                </div>
                                @if($submission->rating !== null)
                                    <div class="status-badge graded">
                                        <i class="fas fa-check-circle me-1"></i>Graded
                                    </div>
                                @else
                                    <div class="status-badge pending">
                                        <i class="fas fa-clock me-1"></i>Pending
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="response-body">
                        <div class="response-preview">
                            {!! Str::limit(strip_tags($submission->responses), 200) !!}
                        </div>

                        <!-- Teacher Remarks Section -->
                        <div class="remarks-section">
                            <div class="remarks-header">
                                <h6><i class="fas fa-clipboard-check me-2"></i>Teacher Remarks</h6>
                            </div>

                            @php
                                $obtainedMarks = $submission->rating;
                                $teacherComment = '';

                                // Count input fields in the form HTML content
                                $formHtml = $submission->form->html_content;
                                $inputCount = 0;
                                if ($formHtml) {
                                    $inputCount += substr_count($formHtml, '<input');
                                    $inputCount += substr_count($formHtml, '<textarea');
                                    $inputCount += substr_count($formHtml, '<select');
                                }
                                $totalMarks = $inputCount;

                                // Parse existing comment for teacher feedback
                                if ($submission->comment) {
                                    if (str_contains($submission->comment, '|')) {
                                        $parts = explode('|', $submission->comment, 2);
                                        $teacherComment = $parts[1];
                                    } else if (!str_contains($submission->comment, '/')) {
                                        $teacherComment = $submission->comment;
                                    }
                                }

                                $hasRemarks = $submission->rating !== null || !empty($teacherComment);
                            @endphp

                            <div class="remarks-form">
                                <form action="{{ route('teacher.updateSubmissionRemark', $submission->id) }}" method="POST" class="remarks-form-{{ $submission->id }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="font-size: 0.875rem;">Marks</label>
                                            <div class="marks-input-group">
                                                <input type="number" class="marks-input" name="obtained_marks"
                                                       value="{{ $obtainedMarks }}" placeholder="0" min="0" {{ $hasRemarks ? 'disabled' : '' }}>
                                                <span>/</span>
                                                <input type="number" class="marks-input" name="total_marks"
                                                       placeholder="{{ $totalMarks }}" {{ $hasRemarks ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="font-size: 0.875rem;">Comments</label>
                                        <textarea class="form-control form-control-sm" name="teacher_comment" rows="2"
                                                  placeholder="Add feedback..." {{ $hasRemarks ? 'disabled' : '' }}>{{ $teacherComment }}</textarea>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        @if($hasRemarks)
                                            <button type="button" class="btn btn-warning btn-sm" onclick="enableEdit({{ $submission->id }})">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </button>
                                            <button type="submit" class="btn btn-primary btn-sm" style="display: none;" id="saveBtn-{{ $submission->id }}">
                                                <i class="fas fa-save me-1"></i>Save
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-save me-1"></i>Save
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h4>No Responses Yet</h4>
                    <p>Students haven't submitted responses for this form yet. Share the form link to start collecting responses.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function enableEdit(submissionId) {
            const form = document.querySelector('.remarks-form-' + submissionId);
            const inputs = form.querySelectorAll('input, textarea');
            const editBtn = form.querySelector('button[onclick*="enableEdit"]');
            const saveBtn = document.getElementById('saveBtn-' + submissionId);

            inputs.forEach(input => input.disabled = false);
            editBtn.style.display = 'none';
            saveBtn.style.display = 'inline-block';
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const responseCards = document.querySelectorAll('.response-card');
            
            responseCards.forEach(card => {
                const studentName = card.querySelector('.student-details h6').textContent.toLowerCase();
                const studentEmail = card.querySelector('.student-email').textContent.toLowerCase();
                
                if (studentName.includes(searchTerm) || studentEmail.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Status filter functionality
        document.getElementById('statusFilter').addEventListener('change', function(e) {
            const filterValue = e.target.value;
            const responseCards = document.querySelectorAll('.response-card');
            
            responseCards.forEach(card => {
                const isGraded = card.querySelector('.status-badge.graded');
                
                if (filterValue === 'all') {
                    card.style.display = 'block';
                } else if (filterValue === 'graded' && isGraded) {
                    card.style.display = 'block';
                } else if (filterValue === 'pending' && !isGraded) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Export functionality placeholder
        function exportResponses() {
            alert('Export functionality would be implemented here');
        }
    </script>
</body>
</html>
