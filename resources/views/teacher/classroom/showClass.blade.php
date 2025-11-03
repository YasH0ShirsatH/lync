<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Classroom Forms - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .class-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            overflow: hidden;
        }

        .card-header {
            background: rgba(52, 58, 64, 0.95);
            padding: 25px;
            border-bottom: none;
        }

        .card-title {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
        }

        .card-body {
            padding: 30px;
        }

        .form-element {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }

        .form-label {
            font-weight: 600;
            color: #212529;
            margin-bottom: 10px;
            display: block;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
            background: white;
            font-weight: 500;
        }

        .form-control:disabled, .form-select:disabled {
            background: #f8f9fa;
            opacity: 0.8;
        }

        .form-check {
            margin-bottom: 10px;
        }

        .form-check-input:disabled {
            opacity: 0.6;
        }

        .form-check-label {
            font-weight: 500;
            color: #495057;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .container {
            max-width: 1000px;
        }

        .page-header {
            background: rgba(52, 58, 64, 0.95);
            border-radius: 25px;
            padding: 30px;
            margin-bottom: 40px;
            backdrop-filter: blur(10px);
        }

        .page-title {
            color: white;
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
        }



        .btn-outline-light {
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            border-radius: 20px;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }

        .btn-outline-light:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.5);
            color: white;
            transform: translateY(-2px);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .remove-btn {
            display: none !important;
        }

        .add-form-btn {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 8px 25px rgba(25, 135, 84, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .add-form-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(25, 135, 84, 0.4);
            color: white;
        }

        .add-form-section {
            text-align: center;
            padding: 40px 20px;
            margin: 30px 0;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .btn-edit {
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #0b5ed7 0%, #5a0fc8 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #bb2d3b 0%, #e55a00 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid #f8f9fa;
        }

        @media (max-width: 768px) {
            .form-actions {
                flex-direction: column;
                gap: 10px;
            }

            .btn-edit, .btn-delete {
                justify-content: center;
                width: 100%;
            }
        }

        .classroom-badges {
            margin-bottom: 20px;
        }

        .classroom-badge {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-right: 10px;
            margin-bottom: 10px;
            display: inline-block;
            border: 1px solid rgba(13, 110, 253, 0.2);
        }

        @media (max-width: 768px) {
            .classroom-badge {
                display: block;
                margin-bottom: 8px;
                text-align: center;
            }

            .card-body {
                padding: 20px;
            }

            .card-header {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    @if($classforms->count() > 0 && $classforms->first()->classroom)
                        <h1 class="page-title">
                            <i class="fas fa-school me-3"></i>{{ $classforms->first()->classroom->name }}
                        </h1>
                    @else
                        <h1 class="page-title">
                            <i class="fas fa-clipboard-list me-3"></i>Classroom Forms
                        </h1>
                    @endif
                </div>
                <a href="{{ route('teacher.classroom.setup') }}" class="btn btn-outline-light btn-sm mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-1"></i>Back to Classrooms
                </a>
            </div>
        </div>

        @if($classforms->count() > 0)
            @php
                $formsByTitle = $classforms->groupBy('form.title');
            @endphp

            @foreach($formsByTitle as $formTitle => $forms)
                <div class="class-card">
                    @if($forms->first()->form)
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-file-alt me-2"></i>{{ $formTitle }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="classroom-badges">
                                <strong class="text-muted mb-2 d-block">
                                    <i class="fas fa-school me-1"></i>Available in other Classrooms:
                                </strong>
                                @foreach($forms->first()->allClassrooms as $classroomForm)
                                    @if($classroomForm->classroom && $classroomForm->classroom_id != $id)
                                        <a class="text-decoration-none" href="/teacher/classroom/show/{{$classroomForm->classroom->id}}" >
                                            <span class="classroom-badge">
                                                <i class="fas fa-chalkboard-teacher me-1"></i>{{ $classroomForm->classroom->name }}
                                            </span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="form-content">{!! $forms->first()->form->html_content !!}</div>

                            <div class="form-actions">
                                <a href="{{ route('teacher.editForm', $forms->first()->form->id) }}?classroom_id={{ $id }}" class="btn-edit">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <a href="{{ route('teacher.classroom.removeForm', [$forms->first()->classroom_id, $forms->first()->form->id]) }}"
                                   onclick="return confirm('Are you sure you want to remove this form from this classroom?');"
                                   class="btn-delete">
                                    <i class="fas fa-times me-1"></i>Remove
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="add-form-section">
                <a href="{{ route('teacher.formBuilder') }}" class="add-form-btn">
                    <i class="fas fa-plus me-2"></i>Add New Form
                </a>
            </div>
        @else
            <div class="class-card">
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h4>No Forms Available</h4>
                    <p>There are no forms assigned to your classrooms yet.</p>
                    <div class="mt-4">
                        <a href="{{ route('teacher.formBuilder') }}" class="add-form-btn">
                            <i class="fas fa-plus me-2"></i>Add Your First Form
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
