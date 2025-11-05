<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}} | Page Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{asset('css/laravel-grapes.css')}}" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .editor-toolbar {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 0;
            box-shadow: var(--shadow-sm);
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
            background: linear-gradient(135deg, #10b981, #059669);
            color: var(--white);
        }
        .btn-outline-secondary {
            border: 1px solid var(--gray-300);
            color: var(--gray-700);
        }
        .btn-modern:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .navbar-container {
            max-width: 1400px;
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
                    <h4 class="mb-0 me-3" style="color: var(--gray-800); font-weight: 600;">
                        <i class="fas fa-paint-brush me-2" style="color: var(--primary-600);"></i>
                        Page Builder
                    </h4>
                </div>
                <div class="d-flex gap-2">
                    <button id="previewBtn" class="btn btn-outline-secondary btn-modern">
                        <i class="fas fa-eye me-1"></i> Preview
                    </button>

                    <button id="saveBtn" class="btn btn-success btn-modern">
                        <i class="fas fa-save me-1"></i> Save Page
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Editor Container -->
    <div class="editor-container">
        <div class="navbar-container">
            <input id="Pages" type="hidden" pages-data='@json($pages)'>
            <input id="Languages" type="hidden" lang-data='@json([])'>
            <div id="gjs" class="gjs-editor-cont"></div>
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
        document.addEventListener('DOMContentLoaded', function() {
            let isPreviewMode = false;
            const previewBtn = document.getElementById('previewBtn');
            const codeBtn = document.getElementById('codeBtn');

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

            // Code view functionality
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
        });
    </script>
</body>
</html>
