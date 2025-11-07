<!DOCTYPE html>
<html>
<head>
    <title>Global Form Submissions</title>
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

        /* Stats Section */
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

        .stat-icon.submissions {
            background: rgba(14, 165, 233, 0.1);
            color: var(--primary-blue);
        }

        .stat-icon.forms {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .stat-icon.users {
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

        /* Controls Bar */
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

        /* Submission Cards */
        .submissions-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .submission-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .submission-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            border-color: var(--primary-blue);
        }

        .submission-header {
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-100) 100%);
            padding: 1.25rem;
            border-bottom: 1px solid var(--neutral-200);
        }

        .submitter-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .submitter-main {
            display: flex;
            align-items: center;
        }

        .submitter-avatar {
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

        .submitter-details h6 {
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
            color: var(--neutral-800);
        }

        .submitter-email {
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

        .type-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-top: 0.5rem;
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

        .submission-body {
            padding: 1.5rem;
            background: white;
        }

        .submission-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .form-badge {
            background: var(--primary-50);
            color: var(--primary-700);
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .response-count {
            color: var(--neutral-500);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .view-details-btn {
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .view-details-btn:hover {
            background: var(--primary-blue-dark);
            color: white;
            transform: translateY(-1px);
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

        /* Pagination */
        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }

        .page-link {
            color: var(--primary-blue);
            border-color: var(--neutral-300);
        }

        .page-link:hover {
            color: var(--primary-blue-dark);
            background-color: var(--neutral-100);
            border-color: var(--neutral-300);
        }

        .page-item.active .page-link {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
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

            .submission-body {
                padding: 1rem;
            }

            .submitter-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .submission-meta {
                text-align: left;
            }

            .submission-summary {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
        }ntent: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: linear-gradient(transparent, white);
        }

        .view-details-btn {
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .view-details-btn:hover {
            background: var(--primary-blue-dark);
            color: white;
            transform: translateY(-1px);
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

        /* Pagination */
        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }

        .page-link {
            color: var(--primary-blue);
            border-color: var(--neutral-300);
        }

        .page-link:hover {
            color: var(--primary-blue-dark);
            background-color: var(--neutral-100);
            border-color: var(--neutral-300);
        }

        .page-item.active .page-link {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
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

            .submission-body {
                padding: 1rem;
            }

            .submitter-info {
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
                        <i class="fas fa-globe me-2"></i>Global Form Submissions
                    </h1>
                    <p class="page-subtitle">All form submissions from your website forms</p>
                </div>
                <a href="{{ route('teacher.dashboard') }}" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon submissions">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $submissions->total() }}</div>
                    <div class="stat-label">Total Submissions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon forms">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $submissions->pluck('form_id')->unique()->count() }}</div>
                    <div class="stat-label">Forms with Submissions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon users">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $submissions->pluck('submitter_email')->unique()->count() }}</div>
                    <div class="stat-label">Unique Submitters</div>
                </div>
            </div>

            <!-- Controls Bar -->
            <div class="controls-bar">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search by name or email..." id="searchInput">
                    </div>
                    <div class="d-flex flex-column flex-md-row gap-3">
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" style="width: auto;" id="typeFilter">
                            <option value="all">All Types</option>
                            <option value="teacher">Teachers</option>
                            <option value="student">Students</option>
                            <option value="guest">Guests</option>
                        </select>
                    </div>
                   <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" style="width: auto;" id="formFilter">
                            <option value="all">All Forms</option>
                            @foreach($submissions->unique('form_id') as $submission)
                                <option value="{{ $submission->form->id }}">{{ $submission->form->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    </div>




                </div>
            </div>
        </div>

        <!-- Submissions Grid -->
        <div class="submissions-grid">
            @forelse($submissions as $submission)
                <div class="submission-card">
                    <div class="submission-header">
                        <div class="submitter-info">
                            <div class="submitter-main">
                                <div class="submitter-avatar">
                                    {{ strtoupper(substr($submission->submitter_name, 0, 1)) }}
                                </div>
                                <div class="submitter-details">
                                    <h6>{{ $submission->submitter_name }}</h6>
                                    <div class="submitter-email">{{ $submission->submitter_email }}</div>
                                </div>
                            </div>
                            <div class="submission-meta">
                                <div class="submission-time">
                                    <i class="fas fa-clock me-1"></i>{{ $submission->created_at->diffForHumans() }}
                                </div>
                                <div class="type-badge {{ $submission->submitter_type }}">
                                    <i class="fas fa-{{ $submission->submitter_type === 'teacher' ? 'chalkboard-teacher' : ($submission->submitter_type === 'student' ? 'user-graduate' : 'user') }} me-1"></i>
                                    {{ ucfirst($submission->submitter_type) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submission-body">
                        <div class="submission-summary">
                            <div class="form-badge">
                                <i class="fas fa-file-text"></i>
                                {{ $submission->form->title ?? 'Form' }}
                            </div>
                            <div class="response-count">
                                <i class="fas fa-list"></i>
                                {{ is_array($submission->form_responses) ? count($submission->form_responses) : 0 }} fields
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>{{ $submission->created_at->format('M d, Y \a\t H:i') }}
                            </small>
                            <a href="{{route('teacher.viewGlobalFormSubmission',$submission->id)}}" class="view-details-btn">
                                <i class="fas fa-eye"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h4>No Submissions Yet</h4>
                    <p>No form submissions have been received from your website forms yet.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($submissions->hasPages())
            <div class="d-flex justify-content-center">
                {{ $submissions->links() }}
            </div>
        @endif
    </div>

    <!-- Submission Details Modal -->
    <div class="modal fade" id="submissionModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submission Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="submissionDetails">
                    <!-- Details will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const submissionCards = document.querySelectorAll('.submission-card');

            submissionCards.forEach(card => {
                const submitterName = card.querySelector('.submitter-details h6').textContent.toLowerCase();
                const submitterEmail = card.querySelector('.submitter-email').textContent.toLowerCase();

                if (submitterName.includes(searchTerm) || submitterEmail.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Combined filter functionality
        function applyFilters() {
            const typeFilter = document.getElementById('typeFilter').value;
            const formFilter = document.getElementById('formFilter').value;
            const submissionCards = document.querySelectorAll('.submission-card');

            submissionCards.forEach(card => {
                const typeBadge = card.querySelector('.type-badge');
                const submitterType = typeBadge.textContent.toLowerCase().trim();
                const formBadge = card.querySelector('.form-badge');
                const formTitle = formBadge.textContent.trim();

                // Check type filter
                const typeMatch = typeFilter === 'all' || submitterType === typeFilter;

                // Check form filter
                let formMatch = formFilter === 'all';
                if (!formMatch) {
                    const option = document.querySelector(`#formFilter option[value="${formFilter}"]`);
                    formMatch = option && formTitle === option.textContent;
                }

                // Show card only if both filters match
                if (typeMatch && formMatch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Add event listeners to both filters
        document.getElementById('typeFilter').addEventListener('change', applyFilters);
        document.getElementById('formFilter').addEventListener('change', applyFilters);


        // View submission details

    </script>
</body>
</html>
