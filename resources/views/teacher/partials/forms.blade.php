@if(count($forms) > 0)
    <div class="row">
        @foreach($forms as $form)
            <div class="col-md-6 mb-4">
                @php
                    $assignedClassroomIds = $form->classroomForms->pluck('classroom_id')->unique()->toArray();
                    $assignedClassrooms = $form->classroomForms->unique('classroom_id');
                    $availableClassrooms = $classroomSetup->whereNotIn('id', $assignedClassroomIds)->unique('id');
                @endphp

                <div class="card border-0 form-item-card" style="overflow: visible;">
                    <div class="card-body p-4">
                        <h5 class="card-title">{{ $loop->iteration + ($forms->currentPage() - 1) * $forms->perPage() }}. {{ $form->title }}</h5>

                        <div class="form-meta">
                            <p class="card-text text-muted mb-0">Created: {{ $form->created_at->format('d M Y') }}</p>
                            <p class="card-text text-muted mb-0">Updated: {{ $form->updated_at->format('d M Y') }}</p>
                        </div>

                        @if($assignedClassrooms->count() > 0)
                            <div class="classroom-badges">
                                <span class="classroom-label">
                                    <i class="fas fa-school me-1"></i>Classrooms:
                                </span>
                                @foreach($assignedClassrooms as $classroomForm)
                                    @if($classroomForm->classroom)
                                        <a href="/teacher/classroom/show/{{$classroomForm->classroom->id}}">
                                            <span class="classroom-badge" role="button">
                                                {{ $classroomForm->classroom->name }}
                                            </span>
                                        </a>
                                    @endif
                                @endforeach
                                @if($availableClassrooms->count() > 0)
                                    <span class="classroom-badge add-classroom-btn" role="button" data-form-id="{{ $form->id }}" style="background: #198754; color: white; cursor: pointer;">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                @endif
                            </div>
                        @endif
                        <div class="classroom-badges">
                              <span class="classroom-label">
                                   <i class="fas fa-school me-1"></i>Responses Count: {{$submissions->where('form_id',$form->id)->count() ?? 0}}
                              </span>
                        </div>
                        <div class="form-actions">
                            <a href="{{route('teacher.showForm',$form->id)}}" class="btn btn-sm btn-success">
                                <i class="fas fa-eye me-1"></i>View Form
                            </a>

                            <a href="{{route('teacher.editForm',$form->id)}}" class="btn btn-md fs-6 btn-warning">
                                <i class="fas fa-edit me-1"></i>Edit Form
                            </a>
                            <a href="{{route('teacher.deleteForm',$form->id)}}" onclick="return confirm('Are you sure you want to delete this form?');" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash me-1"></i>Delete
                            </a>
                        </div>
                    </div>

                    @if($availableClassrooms->count() > 0)
                        <div class="classroom-assignment" id="assignment-{{ $form->id }}" style="display: none; background: white; border-top: 2px solid #f8f9fa; padding: 20px; margin: 0;">
                            <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px; padding: 18px;">
                                <label class="assignment-label" style="font-size: 0.8rem; color: #6c757d; font-weight: 600; margin-bottom: 10px; display: block;">
                                    <i class="fas fa-plus-circle me-1"></i>Add to More Classrooms
                                </label>
                                <select class="selectpicker form-control" data-form-id="{{ $form->id }}" id="classroom-select-{{ $form->id }}" multiple data-live-search="true" title="Select classrooms..." style="margin-bottom: 12px;">
                                    @foreach($availableClassrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="assign-btn w-100" data-form-id="{{ $form->id }}" style="background: linear-gradient(135deg, #198754 0%, #20c997 100%); border: none; border-radius: 15px; padding: 10px 20px; font-weight: 600; font-size: 0.9rem; color: white; box-shadow: 0 3px 10px rgba(25, 135, 84, 0.25);">
                                    <i class="fas fa-check me-2"></i>Assign Selected
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center text-muted py-4 empty-state">
        <i class="fas fa-file-alt fa-3x mb-3"></i>
        <p class="mb-0">No forms created yet. Use the <a class='text-decoration-none text-warning' href="/teacher/formBuilder">Form Builder</a> to create your first form.</p>
    </div>
@endif
