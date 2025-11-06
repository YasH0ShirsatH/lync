@if(count($forms) > 0)
    <div class="forms-grid">
        @foreach($forms as $form)
            @php
                $assignedClassroomIds = $form->classroomForms->pluck('classroom_id')->unique()->toArray();
                $assignedClassrooms = $form->classroomForms->unique('classroom_id');
                $availableClassrooms = $classroomSetup->whereNotIn('id', $assignedClassroomIds)->unique('id');
                $responseCount = $submissions->where('form_id',$form->id)->count() ?? 0;
            @endphp

            <div class="form-card">
                <!-- Form Header -->
                <div class="form-header">
                    <div class="form-title-section">
                        <h3 class="form-title">{{ $form->title }}</h3>
                        <span class="form-id">#{{ $loop->iteration + ($forms->currentPage() - 1) * $forms->perPage() }}</span>
                    </div>
                    <div class="form-status">
                        @if($assignedClassrooms->count() > 0)
                            <span class="status-badge active">Active</span>
                        @else
                            <span class="status-badge draft">Draft</span>
                        @endif
                    </div>
                </div>

                <!-- Form Metrics -->
                <div class="form-metrics">
                    <div class="metric-item">
                        <div class="metric-icon responses">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="metric-content">
                            <span class="metric-value">{{ $responseCount }}</span>
                            <span class="metric-label">Responses</span>
                        </div>
                        @if($assignedClassrooms->count() > 0 && $responseCount > 0)
                            <a href="{{ route('teacher.classroom.viewResponses', [$assignedClassrooms->first()->classroom_id, $form->id]) }}" class="metric-action">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        @endif
                    </div>
                    <div class="metric-item">
                        <div class="metric-icon classrooms">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="metric-content">
                            <span class="metric-value">{{ $assignedClassrooms->count() }}</span>
                            <span class="metric-label">Classrooms</span>
                        </div>
                    </div>
                </div>

                <!-- Form Timestamps -->
                <div class="form-timestamps">
                    <div class="timestamp-item">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Created {{ $form->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="timestamp-item">
                        <i class="fas fa-edit"></i>
                        <span>Updated {{ $form->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <!-- Assigned Classrooms -->
                @if($assignedClassrooms->count() > 0)
                    <div class="classroom-section">
                        <div class="section-header">
                            <span class="section-title">Assigned Classrooms</span>
                            @if($availableClassrooms->count() > 0)
                                <button class="add-classroom-btn" type="button" data-form-id="{{ $form->id }}">
                                    <i class="fas fa-plus"></i>
                                </button>
                            @endif
                        </div>
                        <div class="classroom-tags">
                            @foreach($assignedClassrooms as $classroomForm)
                                @if($classroomForm->classroom)
                                    <a href="/teacher/classroom/show/{{$classroomForm->classroom->id}}" class="classroom-tag">
                                        {{ $classroomForm->classroom->name }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        @if($availableClassrooms->count() > 0)
                            <div id="assignment-{{ $form->id }}" class="assignment-panel">
                                <label class="assignment-label">
                                    <i class="fas fa-plus-circle"></i>
                                    Add to More Classrooms
                                </label>
                                <select class="selectpicker form-control" data-form-id="{{ $form->id }}" id="classroom-select-{{ $form->id }}" multiple data-live-search="true" title="Select classrooms...">
                                    @foreach($availableClassrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="assign-btn" data-form-id="{{ $form->id }}">
                                    <i class="fas fa-check"></i>
                                    Assign Selected
                                </button>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{route('teacher.showForm',$form->id)}}" class="action-btn primary">
                        <i class="fas fa-eye"></i>
                        <span>View</span>
                    </a>
                    <a href="{{route('teacher.editForm',$form->id)}}" class="action-btn secondary">
                        <i class="fas fa-edit"></i>
                        <span>Edit</span>
                    </a>
                    <a href="{{route('teacher.deleteForm',$form->id)}}" onclick="return confirm('Are you sure you want to delete this form?');" class="action-btn danger">
                        <i class="fas fa-trash"></i>
                        <span>Delete</span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fas fa-wpforms"></i>
        </div>
        <h3 class="empty-state-title">Ready to Get Started?</h3>
        <p class="empty-state-description">No forms created yet. Build professional forms, surveys, and assessments with our intuitive form builder.</p>
        <a href="/teacher/formBuilder" class="empty-state-btn">
            <i class="fas fa-plus"></i>
            Create Your First Form
        </a>
    </div>
@endif

<style>
/* Professional MNC-Style Form View */
:root {
    --primary-50: #f0f9ff;
    --primary-100: #e0f2fe;
    --primary-500: #0ea5e9;
    --primary-600: #0284c7;
    --primary-700: #0369a1;
    --gray-50: #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-300: #cbd5e1;
    --gray-400: #94a3b8;
    --gray-500: #64748b;
    --gray-600: #475569;
    --gray-700: #334155;
    --gray-800: #1e293b;
    --gray-900: #0f172a;
    --success-50: #f0fdf4;
    --success-500: #22c55e;
    --success-600: #16a34a;
    --warning-50: #fffbeb;
    --warning-500: #f59e0b;
    --danger-50: #fef2f2;
    --danger-500: #ef4444;
    --white: #ffffff;
    --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    --radius-md: 0.5rem;
    --radius-lg: 0.75rem;
    --radius-xl: 1rem;
}

.forms-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

@media (max-width: 768px) {
    .forms-grid {
        grid-template-columns: 1fr;
    }
}

.form-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-xl);
    padding: 1.5rem;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: var(--shadow-sm);
}

.form-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    border-color: var(--gray-300);
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--gray-200);
}

.form-title-section {
    flex: 1;
}

.form-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-900);
    margin: 0 0 0.25rem 0;
    line-height: 1.3;
}

.form-id {
    font-size: 0.875rem;
    color: var(--gray-500);
    font-weight: 500;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.status-badge.active {
    background: var(--success-50);
    color: var(--success-600);
}

.status-badge.draft {
    background: var(--gray-100);
    color: var(--gray-600);
}

.form-metrics {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.metric-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    border: 1px solid var(--gray-200);
}

.metric-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.metric-icon.responses {
    background: var(--primary-50);
    color: var(--primary-600);
}

.metric-icon.classrooms {
    background: var(--success-50);
    color: var(--success-600);
}

.metric-content {
    flex: 1;
}

.metric-value {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--gray-900);
    line-height: 1;
}

.metric-label {
    font-size: 0.75rem;
    color: var(--gray-500);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.metric-action {
    color: var(--gray-400);
    transition: color 0.2s ease;
    text-decoration: none;
}

.metric-action:hover {
    color: var(--primary-600);
}

.form-timestamps {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    padding: 0.75rem;
    background: var(--gray-50);
    border-radius: var(--radius-md);
    border: 1px solid var(--gray-200);
}

.timestamp-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    color: var(--gray-600);
}

.timestamp-item i {
    color: var(--gray-400);
}

.classroom-section {
    margin-bottom: 1.5rem;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.section-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--gray-700);
}

.add-classroom-btn {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: var(--primary-50);
    color: var(--primary-600);
    border: 1px solid var(--primary-200);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.add-classroom-btn:hover {
    background: var(--primary-100);
    transform: scale(1.1);
}

.classroom-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.classroom-tag {
    padding: 0.375rem 0.75rem;
    background: var(--gray-100);
    color: var(--gray-700);
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    border: 1px solid var(--gray-200);
}

.classroom-tag:hover {
    background: var(--primary-50);
    color: var(--primary-700);
    border-color: var(--primary-200);
}

.assignment-panel {
    display: none;
    padding: 1rem;
    background: var(--gray-50);
    border-radius: var(--radius-md);
    border: 1px solid var(--gray-200);
}

.assignment-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-700);
    margin-bottom: 0.75rem;
}

.assign-btn {
    width: 100%;
    padding: 0.75rem 1rem;
    background: var(--primary-500);
    color: var(--white);
    border: none;
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 0.75rem;
}

.assign-btn:hover {
    background: var(--primary-600);
    transform: translateY(-1px);
}

.form-actions {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 0.75rem;
}

.action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

.action-btn.primary {
    background: var(--primary-50);
    color: var(--primary-700);
    border-color: var(--primary-200);
}

.action-btn.primary:hover {
    background: var(--primary-100);
    color: var(--primary-800);
    transform: translateY(-1px);
}

.action-btn.secondary {
    background: var(--warning-50);
    color: var(--warning-700);
    border-color: var(--warning-200);
}

.action-btn.secondary:hover {
    background: var(--warning-100);
    color: var(--warning-800);
    transform: translateY(-1px);
}

.action-btn.danger {
    background: var(--danger-50);
    color: var(--danger-700);
    border-color: var(--danger-200);
}

.action-btn.danger:hover {
    background: var(--danger-100);
    color: var(--danger-800);
    transform: translateY(-1px);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--white);
    border: 2px dashed var(--gray-300);
    border-radius: var(--radius-xl);
    margin: 2rem 0;
}

.empty-state-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: var(--gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--gray-400);
}

.empty-state-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 0.5rem;
}

.empty-state-description {
    font-size: 1rem;
    color: var(--gray-600);
    margin-bottom: 2rem;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.empty-state-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    background: var(--primary-500);
    color: var(--white);
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.empty-state-btn:hover {
    background: var(--primary-600);
    transform: translateY(-1px);
    color: var(--white);
}

@media (max-width: 768px) {
    .forms-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .form-metrics {
        grid-template-columns: 1fr;
    }
    
    .form-timestamps {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .form-actions {
        grid-template-columns: 1fr;
    }
}
</style>