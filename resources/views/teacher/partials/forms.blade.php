@if(count($forms) > 0)
    <div class="row g-4"> {{-- Changed `mb-4` on column to `g-4` on row for better spacing --}}
        @foreach($forms as $form)
            <div class="col-md-6"> {{-- 2 cards per row --}}
                @php
                    // This PHP logic block remains unchanged
                    $assignedClassroomIds = $form->classroomForms->pluck('classroom_id')->unique()->toArray();
                    $assignedClassrooms = $form->classroomForms->unique('classroom_id');
                    $availableClassrooms = $classroomSetup->whereNotIn('id', $assignedClassroomIds)->unique('id');
                @endphp

                <div class="card border-0 h-100 form-item-card" style="border-radius: 20px; background: white;     box-shadow: 0 8px 16px rgb(0 0 0 / 40%); transition: all 0.3s ease;">

                    <div class="card-header d-flex justify-content-between align-items-center" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; border-radius: 20px 20px 0 0; padding: 1.5rem;">
                        <h5 class="mb-0" style="color: #1e293b; font-weight: 600;">{{ $form->title }}</h5>
                        <small class="text-muted">#{{ $loop->iteration + ($forms->currentPage() - 1) * $forms->perPage() }}</small>
                    </div>

                    <div class="card-body p-4">

                        <div class="mb-3" style="background: #f8fafc; padding: 0.75rem; border-radius: 16px; border: 1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-plus me-1"></i>Created {{ $form->created_at->format('M d, Y') }}
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-edit me-1"></i>Updated {{ $form->updated_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>

                        @if($assignedClassrooms->count() > 0)

                                <div class="mb-3" style="background: #f8fafc; padding: 0.75rem; border-radius: 16px; border: 1px solid #e2e8f0;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-chart-bar me-1"></i>{{$submissions->where('form_id',$form->id)->count() ?? 0}} responses
                                        </small>
                                        <a href="{{ route('teacher.classroom.viewResponses', [$assignedClassrooms->first()->classroom_id, $form->id]) }}" class="btn btn-sm" style="background: #e0f2fe; color: #0277bd; border-radius: 20px; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; text-decoration: none;">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </div>
                                </div>

                        @else
                            <div class="mb-3" style="background: #f8fafc; padding: 0.75rem; border-radius: 16px; border: 1px solid #e2e8f0;">
                                <small class="text-muted">
                                    <i class="fas fa-chart-bar me-1"></i>{{$submissions->where('form_id',$form->id)->count() ?? 0}} responses
                                </small>
                            </div>
                        @endif

                        @if($assignedClassrooms->count() > 0)
                            <div class="mb-3" style="background: #f8fafc; padding: 0.75rem; border-radius: 16px; border: 1px solid #e2e8f0;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-school me-1"></i>Classrooms:
                                    </small>
                                    @if($availableClassrooms->count() > 0)
                                        <button class="btn add-classroom-btn" type="button" data-form-id="{{ $form->id }}" style="width: 20px; height: 20px; border-radius: 50%; background: #d1fae5; color: #065f46; border: none; display: flex; align-items: center; justify-content: center; font-size: 0.6rem; padding: 0;">
                                            <i class="fas fa-plus" style="font-size : 8px"></i>
                                        </button>
                                    @endif
                                </div>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($assignedClassrooms as $classroomForm)
                                        @if($classroomForm->classroom)
                                            <a href="/teacher/classroom/show/{{$classroomForm->classroom->id}}" class="badge text-decoration-none" style="background: #e2e8f0; color: #64748b; border-radius: 20px; padding: 0.25rem 0.75rem;">
                                                {{ $classroomForm->classroom->name }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                                @if($availableClassrooms->count() > 0)
                                    <div id="assignment-{{ $form->id }}" style="display: none; margin-top: 1rem;">
                                        <label class="form-label small text-muted mb-2">
                                            <i class="fas fa-plus-circle me-1"></i>Add to More Classrooms
                                        </label>
                                        <select class="selectpicker form-control mb-2" data-form-id="{{ $form->id }}" id="classroom-select-{{ $form->id }}" multiple data-live-search="true" title="Select classrooms...">
                                            @foreach($availableClassrooms as $classroom)
                                                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn w-100 assign-btn" data-form-id="{{ $form->id }}" style="background: #d1fae5; color: #065f46; border-radius: 25px; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500;">
                                            <i class="fas fa-check me-2"></i>Assign Selected
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="d-flex gap-2">
                            <a href="{{route('teacher.showForm',$form->id)}}" class="btn flex-grow-1" style="background: #b6fbe4; color: black; border-radius: 25px; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500;">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            <a href="{{route('teacher.editForm',$form->id)}}" class="btn flex-grow-1" style="background: #ffdda3; color: black; border-radius: 25px; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500;">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="{{route('teacher.deleteForm',$form->id)}}" onclick="return confirm('Are you sure you want to delete this form?');" class="btn flex-grow-1" style="background: #ffacac; color: black; border-radius: 25px; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500;">
                                <i class="fas fa-trash me-1"></i>Delete
                            </a>
                        </div>
                    </div>



                </div>
            </div>
        @endforeach
    </div>
@else
    {{-- Empty State (Unchanged, already looks professional) --}}
    <div class="alert alert-info text-center shadow-sm p-5 rounded-4" role="alert">
        <i class="fas fa-file-alt fa-5x mb-4 text-info"></i>
        <h4 class="alert-heading mb-3">No Forms Created Yet!</h4>
        <p class="lead mb-4">It looks like you haven't built any forms. Let's get started!</p>
        <hr>
        <p class="mb-0">Use the <a href="/teacher/formBuilder" class="alert-link fw-bold">Form Builder</a> to create your first professional form.</p>
    </div>
@endif

<style>
.form-item-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
}
.add-classroom-btn {
    /* No hover effects */
}
</style>
