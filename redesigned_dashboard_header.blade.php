<!-- Modern Dashboard Header -->
<div class="dashboard-header-container" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 24px; padding: 2rem; margin-bottom: 2rem; position: relative; overflow: hidden;">
    <!-- Background Pattern -->
    <div style="position: absolute; top: 0; right: 0; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; transform: translate(50%, -50%);"></div>
    <div style="position: absolute; bottom: 0; left: 0; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%; transform: translate(-30%, 30%);"></div>
    
    <div class="row align-items-center">
        <div class="col-lg-8">
            <div class="welcome-content" style="color: white; position: relative; z-index: 2;">
                <h1 class="welcome-title mb-2" style="font-size: 2.5rem; font-weight: 700; margin: 0;">
                    Good {{ date('H') < 12 ? 'Morning' : (date('H') < 17 ? 'Afternoon' : 'Evening') }}!
                </h1>
                <p class="welcome-subtitle mb-0" style="font-size: 1.1rem; opacity: 0.9; font-weight: 400;">
                    Welcome back, <strong style="color: #fbbf24;">{{ Auth::guard('teacher')->user()->name }}</strong>
                </p>
                <div class="mt-3" style="display: flex; gap: 1rem; align-items: center;">
                    <span style="background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.875rem;">
                        <i class="fas fa-calendar-day me-1"></i>{{ date('M d, Y') }}
                    </span>
                    <span style="background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.875rem;">
                        <i class="fas fa-clock me-1"></i>{{ date('g:i A') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-end">
            <div class="teacher-avatar" style="position: relative; z-index: 2;">
                <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-left: auto; border: 3px solid rgba(255,255,255,0.3);">
                    <i class="fas fa-user-tie" style="font-size: 2rem; color: white;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4" role="alert" style="border-radius: 16px; background: #f0fdf4; border-left: 4px solid #22c55e !important;">
        <div class="d-flex align-items-center">
            <div class="me-3" style="width: 40px; height: 40px; background: #22c55e; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-check" style="color: white; font-size: 1rem;"></i>
            </div>
            <div class="flex-grow-1">
                <strong style="color: #166534;">Success!</strong>
                <div style="color: #15803d; margin-top: 0.25rem;">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: hue-rotate(120deg);"></button>
        </div>
    </div>
@endif

<!-- Enhanced Stats Grid -->
<div class="stats-grid mb-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
    <div class="stat-card" style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #f1f5f9; transition: all 0.3s ease; position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 50%; opacity: 0.1;"></div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="stat-icon" style="width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-clipboard-list" style="color: white; font-size: 1.5rem;"></i>
            </div>
            <div class="text-end">
                <div class="stat-value" style="font-size: 2.5rem; font-weight: 700; color: #1e293b; line-height: 1;">{{ $forms->total() }}</div>
                <div class="stat-label" style="color: #64748b; font-size: 0.875rem; font-weight: 500;">Total Forms</div>
            </div>
        </div>
        <div style="background: #f8fafc; padding: 0.75rem; border-radius: 12px; margin-top: 1rem;">
            <small style="color: #64748b;">
                <i class="fas fa-chart-line me-1" style="color: #22c55e;"></i>
                Forms created and managed
            </small>
        </div>
    </div>

    <div class="stat-card" style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #f1f5f9; transition: all 0.3s ease; position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; opacity: 0.1;"></div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="stat-icon" style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-school" style="color: white; font-size: 1.5rem;"></i>
            </div>
            <div class="text-end">
                <div class="stat-value" style="font-size: 2.5rem; font-weight: 700; color: #1e293b; line-height: 1;">{{ $classroomSetup->count() }}</div>
                <div class="stat-label" style="color: #64748b; font-size: 0.875rem; font-weight: 500;">Active Classrooms</div>
            </div>
        </div>
        <div style="background: #f0fdf4; padding: 0.75rem; border-radius: 12px; margin-top: 1rem;">
            <small style="color: #166534;">
                <i class="fas fa-users me-1" style="color: #10b981;"></i>
                Classrooms under management
            </small>
        </div>
    </div>

    <div class="stat-card" style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #f1f5f9; transition: all 0.3s ease; position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%; opacity: 0.1;"></div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="stat-icon" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-user-tie" style="color: white; font-size: 1.5rem;"></i>
            </div>
            <div class="text-end">
                <div class="stat-value" style="font-size: 1.25rem; font-weight: 600; color: #1e293b; line-height: 1.2;">{{ Str::limit(Auth::guard('teacher')->user()->name, 15) }}</div>
                <div class="stat-label" style="color: #64748b; font-size: 0.875rem; font-weight: 500;">Teacher Profile</div>
            </div>
        </div>
        <div style="background: #fffbeb; padding: 0.75rem; border-radius: 12px; margin-top: 1rem;">
            <small style="color: #92400e;">
                <i class="fas fa-shield-alt me-1" style="color: #f59e0b;"></i>
                Authenticated educator
            </small>
        </div>
    </div>
</div>

<style>
.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.12) !important;
}

@media (max-width: 768px) {
    .dashboard-header-container {
        padding: 1.5rem !important;
    }
    .welcome-title {
        font-size: 2rem !important;
    }
    .stats-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>