<!DOCTYPE html>
<html>
<head>
    <title>Form Responses - {{ $form->title }}</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .response-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            overflow: hidden;
        }
        .response-header {
            background: linear-gradient(135deg, #495057 0%, #6c757d 100%);
            color: white;
            padding: 1.5rem;
        }
        .response-body {
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
            <h1><i class="fas fa-chart-bar me-3"></i>{{ $form->title }} - Responses</h1>
            <p class="mb-0">{{ $classroom->name }}</p>
        </div>

        @forelse($submissions as $submission)
            <div class="response-card">
                <div class="response-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user me-2"></i>{{ $submission->student->name }}
                        <small class="ms-3 opacity-75">{{ $submission->created_at->format('M d, Y H:i') }}</small>
                    </h5>
                </div>
                <div class="response-body">
                    {!! $submission->responses !!}
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <h4>No Responses Yet</h4>
                <p class="text-muted">Students haven't submitted this form yet.</p>
            </div>
        @endforelse
    </div>
</body>
</html>
