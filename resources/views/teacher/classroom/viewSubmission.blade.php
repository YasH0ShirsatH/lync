<!DOCTYPE html>
<html>
<head>
    <title>{{ $submission->form->title }} - {{ $submission->student->name }}</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .submission-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            overflow: hidden;
        }
        .submission-header {
            background: linear-gradient(135deg, #495057 0%, #6c757d 100%);
            color: white;
            padding: 2rem;
        }
        .submission-body {
            padding: 2rem;
        }
        .page-header {
            background: rgba(52, 58, 64, 0.95);
            border-radius: 25px;
            padding: 30px;
            margin-bottom: 40px;
            color: white;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-file-alt me-3"></i>{{ $submission->form->title }}</h1>
                    <p class="mb-0">Submitted by {{ $submission->student->name }} on {{ $submission->created_at->format('M d, Y H:i') }}</p>
                </div>
                <button onclick="history.back()" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </button>
            </div>
        </div>

        <div class="submission-card">
            <div class="submission-header">
                <h4 class="mb-0">
                    <i class="fas fa-user me-2"></i>{{ $submission->student->name }}'s Response
                </h4>
            </div>
            <div class="submission-body">
                {!! $submission->responses !!}
            </div>
        </div>
    </div>
</body>
</html>