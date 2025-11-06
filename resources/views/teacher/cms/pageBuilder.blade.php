<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}} | Page Builder</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{asset('css/laravel-grapes.css')}}" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .editor-toolbar {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-600) 100%);
            border-radius: 16px;
            padding: 2rem;
            margin: 2rem auto;
            max-width : 1350px;
            color: white;
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15);
            position: relative;
            overflow: hidden;
        }

        .gjs-one-bg {
            background: #20506d !important ;
        }

        .gjs-field {
            background-color: white !important;
            color : black !important;
            border: none;
            box-shadow: none;
            border-radius: 2px;
            box-sizing: border-box;
            padding: 0;
            position: relative;
        }

        .gjs-four-color {
            color: black !important;
        }
        .editor-toolbar::before {
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

        .btn-back {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            text-align: unset;
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            display: flex;
            font-weight: 500;
            text-decoration: none;
            align-items: center;
            transition: all 0.2s  ease;
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

        .btn-modern {
            border-radius: var(--radius-md);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            color: var(--white);
        }
        .btn-success {
            background: rgba(16, 185, 129, 0.9);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            position: relative;
            z-index: 1;
        }
        .btn-success:hover {
            background: rgba(16, 185, 129, 1);
            border-color: rgba(255,255,255,0.3);
            color: white;
        }
        .btn-outline-secondary {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            position: relative;
            z-index: 1;
        }
        .btn-outline-secondary:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.3);
            color: white;
        }
        .btn-modern:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .navbar1-container {
            max-width: 1500px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        .editor-container {
            min-height: calc(100vh - 140px);
            background: var(--gray-50);
            padding: 1.5rem 0;
        }
        div#gjs {
            height: calc(100vh - 200px) !important;
            min-height: 600px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            background: var(--white);
        }
    </style>
    @routes
</head>
<body>
    <!-- Include existing navbar -->
    @include('layouts.navbar')

    <!-- Editor Toolbar -->
    <div class="editor-toolbar">
        <div class="navbar-container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div>
                        <h1 class="mb-0" style="font-weight: 700; font-size: 1.875rem; position: relative; z-index: 1;">
                            <i class="fas fa-paint-brush me-2"></i>Page Builder {{$teacher_id}}
                        </h1>
                        <p class="mb-0 mt-2" style="opacity: 0.9; font-size: 1rem; position: relative; z-index: 1;">Create beautiful web pages with drag & drop</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button id="previewBtn" class="btn btn-outline-secondary btn-modern">
                        <i class="fas fa-eye me-1"></i> Preview
                    </button>
                    <a href="/teacher/classroom/cms/websiteLinks" class="btn-back mt-3 mt-md-0">
                                        <i class="fas fa-link me-2"></i>Links
                                    </a>

                    <a href="{{ route('teacher.dashboard') }}" class="btn-back mt-3 mt-md-0">
                                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                                    </a>

                </div>

            </div>
        </div>
    </div>




    <!-- Editor Container -->
    <div class="editor-container">
        <div class="navbar1-container">
            <input id="Pages" type="hidden" pages-data='@json($pages)'>
            <input id="Languages" type="hidden" lang-data='@json([])'>
            <input type="hidden" name="teacher_id" id="teacher_id" value="{{ auth()->user()->id }}">
            <div id="gjs" class="gjs-editor-cont"></div>
            <input type="hidden" name="teacher_id" value="{{ $teacher_id }}">

        </div>
    </div>

    <!-- Toast Notifications -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-info-circle text-primary me-2"></i>
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/js/laravel-grapes.js') }}"></script>

    <script>
        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        // Intercept AJAX requests to add teacher_id
        $(document).ajaxSend(function(event, xhr, settings) {
            console.log('AJAX request intercepted:', settings.url);
            if (settings.url && settings.url.includes('create-page')) {
                console.log('Create-page request detected');
                const teacherId = $('#teacher_id').val();
                console.log('Teacher ID from input:', teacherId);
                console.log('Original data:', settings.data);

                if (teacherId) {
                    // Add teacher_id to the data
                    if (typeof settings.data === 'string') {
                        settings.data += '&teacher_id=' + teacherId;
                    } else if (settings.data) {
                        settings.data.teacher_id = teacherId;
                    } else {
                        settings.data = 'teacher_id=' + teacherId;
                    }
                    console.log('Modified data:', settings.data);
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let isPreviewMode = false;
            const previewBtn = document.getElementById('previewBtn');
            const codeBtn = document.getElementById('codeBtn');

            // Check for edit parameter and set selectPage value
            const urlParams = new URLSearchParams(window.location.search);
            const editPageId = urlParams.get('edit');

            if (editPageId) {
                // Wait for GrapesJS to load and then set the select value
                const checkForSelect = setInterval(() => {
                    const selectPage = document.getElementById('selectPage');
                    if (selectPage) {
                        selectPage.value = editPageId;
                        // Trigger change event to load the page
                        selectPage.dispatchEvent(new Event('change'));
                        clearInterval(checkForSelect);
                    }
                }, 100);
            }

            // Preview toggle functionality
            previewBtn.addEventListener('click', function() {
                if (window.editor) {
                    if (isPreviewMode) {
                        window.editor.stopCommand('preview');
                        this.innerHTML = '<i class="fas fa-eye me-1"></i> Preview';
                        isPreviewMode = false;
                    } else {
                        window.editor.runCommand('preview');
                        this.innerHTML = '<i class="fas fa-times me-1"></i> Exit Preview';
                        isPreviewMode = true;
                    }
                }
            });

            // Code view functionality (if codeBtn exists)
            if (codeBtn) {
                codeBtn.addEventListener('click', function() {
                    if (window.editor) {
                        const html = window.editor.getHtml();
                        const css = window.editor.getCss();
                        const codeContent = `HTML:\n${html}\n\nCSS:\n${css}`;

                        const newWindow = window.open('', '_blank');
                        newWindow.document.write(`
                            <html>
                                <head>
                                    <title>Generated Code</title>
                                    <style>
                                        body { font-family: 'Courier New', monospace; padding: 20px; background: #f8f9fa; }
                                        pre { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); white-space: pre-wrap; }
                                    </style>
                                </head>
                                <body>
                                    <h2>Generated Code</h2>
                                    <pre>${codeContent.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</pre>
                                </body>
                            </html>
                        `);
                    }
                });
            }
        });
    </script>
</body>
</html>
