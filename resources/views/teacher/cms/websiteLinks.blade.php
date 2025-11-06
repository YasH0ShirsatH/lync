<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Website Links - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0ea5e9;
            --secondary-blue: #0284c7;
            --purple-500: #8b5cf6;
            --purple-600: #7c3aed;
            --green-500: #10b981;
            --green-600: #059669;
            --orange-500: #f59e0b;
            --orange-600: #d97706;
            --pink-500: #ec4899;
            --pink-600: #db2777;
            --neutral-50: #f8fafc;
            --neutral-100: #f1f5f9;
            --neutral-200: #e2e8f0;
            --neutral-700: #334155;
            --neutral-800: #1e293b;
        }

        body {
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-100) 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--neutral-800);
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }

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

        .links-section {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .section-title {
            font-weight: 600;
            font-size: 1.125rem;
            color: var(--neutral-800);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .page-card {
            background: white;
            border: 1px solid var(--neutral-200);
            border-radius: 16px;
            padding: 0;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .page-card:hover {
            border-color: var(--primary-blue);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.15);
            transform: translateY(-4px);
        }

        .page-card-header {
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .page-card-header.blue {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        }

        .page-card-header.purple {
            background: linear-gradient(135deg, var(--purple-500) 0%, var(--purple-600) 100%);
        }

        .page-card-header.green {
            background: linear-gradient(135deg, var(--green-500) 0%, var(--green-600) 100%);
        }

        .page-card-header.orange {
            background: linear-gradient(135deg, var(--orange-500) 0%, var(--orange-600) 100%);
        }

        .page-card-header.pink {
            background: linear-gradient(135deg, var(--pink-500) 0%, var(--pink-600) 100%);
        }

        .page-card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-icon {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .page-name {
            font-weight: 700;
            color: white;
            margin: 0;
            font-size: 1.25rem;
            position: relative;
            z-index: 1;
        }

        .page-card-body {
            padding: 1.5rem;
        }

        .page-url {
            background: var(--neutral-50);
            border: 1px solid var(--neutral-200);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 0.875rem;
            color: var(--neutral-700);
            margin-bottom: 1rem;
            word-break: break-all;
        }

        .page-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-view {
            flex: 1;
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .btn-view:hover {
            background: var(--secondary-blue);
            color: white;
            transform: translateY(-1px);
        }

        .btn-copy {
            background: var(--neutral-100);
            color: var(--neutral-700);
            border: 1px solid var(--neutral-200);
            border-radius: 8px;
            padding: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-copy:hover {
            background: var(--neutral-200);
            border-color: var(--neutral-300);
        }

        .page-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--neutral-200);
            font-size: 0.875rem;
            color: var(--neutral-600);
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--neutral-500);
        }

        .empty-icon {
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

        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .alert-success .btn-close {
            filter: brightness(0) invert(1);
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-delete:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .btn-edit {
            background: var(--orange-500);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: var(--orange-600);
            color: white;
            transform: translateY(-1px);
        }

        .copy-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--green-500) 0%, var(--green-600) 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            font-size: 0.875rem;
            z-index: 9999;
            transform: translateX(400px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .copy-toast.show {
            transform: translateX(0);
            opacity: 1;
        }

    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-4">
        <!-- Page Header -->
        <div class="page-header">
            <div id="copyToast" class="copy-toast">
                <i class="fas fa-check-circle"></i>
                <span>Link copied to clipboard!</span>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-link me-2"></i>Website Links
                    </h1>
                    <p class="page-subtitle">View and access all your published pages</p>
                </div>
                <a href="{{ route('teacher.dashboard') }}" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Links Section -->
        <div class="links-section">
            <h3 class="section-title">
                <i class="fas fa-globe"></i>
                Published Pages
            </h3>

            @if($pages->count() > 0)
                <div class="pages-grid">
                    @foreach($pages as $index => $page)
                        @php
                            $colors = ['blue', 'purple', 'green', 'orange', 'pink'];
                            $colorClass = $colors[$index % count($colors)];
                        @endphp
                        <div class="page-card">
                            <div class="page-card-header {{ $colorClass }}">
                                <div class="page-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h4 class="page-name">{{ $page->name }}</h4>
                            </div>
                            <div class="page-card-body">
                                <div class="page-url">
                                    {{ url('/' . $page->slug) }}
                                </div>
                                <div class="page-actions">
                                    <a href="/{{ $page->slug }}" class="btn-view" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        View Page
                                    </a>
                                    <button class="btn-copy" onclick="copyToClipboard('{{ url('/page/' . $page->slug) }}')" title="Copy Link">
                                        <i class="fas fa-copy"></i>
                                    </button>

                                    <a href="{{ route('website.builder.teacher') }}?edit={{ $page->id }}" class="btn-edit" title="Edit Page">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn-delete" onclick="deletePage({{ $page->id }})" title="Delete Page">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="page-stats">
                                    <div class="stat-item">
                                        <i class="fas fa-calendar"></i>
                                        {{ $page->created_at ? $page->created_at->format('M j, Y') : 'Unknown' }}
                                    </div>
                                    <div class="stat-item">
                                        <i class="fas fa-link"></i>
                                        {{ $page->slug }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4 style="color: var(--neutral-600); font-weight: 600; margin-bottom: 0.75rem;">No Pages Yet</h4>
                    <p style="margin: 0;">Create your first page using the Page Builder to see links here.</p>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                showCopyToast();
            }).catch(function() {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showCopyToast();
            });
        }

        function showCopyToast() {
            const toast = document.getElementById('copyToast');
            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 900);
        }


        function deletePage(pageId) {
            if (confirm('Are you sure you want to delete this page? This action cannot be undone.')) {
                fetch(`/pages/${pageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Error deleting page');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting page');
                });
            }
        }
    </script>
</body>
</html>
