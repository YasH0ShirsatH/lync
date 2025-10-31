<style>


@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.modern-navbar {
    background: linear-gradient(135deg, #212529 0%, #343a40 100%);
    padding: 1rem 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    animation: slideDown 0.8s ease-out;
}

.navbar-brand {
    font-size: 1.8rem;
    font-weight: 700;
    color: white !important;
    transition: all 0.3s ease;
}

.navbar-brand:hover {
    animation: pulse 0.6s ease;
    color: #f8f9fa !important;
}

.navbar-brand i {
    font-size: 2rem;
    margin-right: 0.5rem;
    color: #0d6efd;
}

.nav-link {
    color: rgba(255,255,255,0.9) !important;
    font-weight: 500;
    font-size: 1.1rem;
    padding: 0.8rem 1.2rem !important;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.1);
    transition: left 0.3s ease;
}

.nav-link:hover::before {
    left: 0;
}

.nav-link:hover {
    color: white !important;
    background: rgba(255,255,255,0.1);
    transform: translateY(-2px);
}

.nav-link i {
    font-size: 1.2rem;
    margin-right: 0.5rem;
}

.user-dropdown {
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.2);
    color: white;
    padding: 0.6rem 1.2rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.user-dropdown:hover {
    background: rgba(255,255,255,0.2);
    border-color: rgba(255,255,255,0.4);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.4);
}

.dropdown-menu {
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    border-radius: 12px;
    padding: 0.5rem 0;
    animation: fadeIn 0.3s ease;
    background: white;
}

.dropdown-item {
    padding: 0.7rem 1.5rem;
    transition: all 0.2s ease;
    font-weight: 500;
    color: #212529;
}



.dropdown-item i {
    width: 20px;
    text-align: center;
}

.navbar-toggler {
    border: 2px solid rgba(255,255,255,0.3);
    padding: 0.5rem;
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.25);
}
</style>

<nav class="navbar navbar-expand-lg modern-navbar">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="{{ route('teacher.dashboard') }}">
            <i class="fas fa-graduation-cap"></i>Lync
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('teacher.dashboard') }}">
                        <i class="fas fa-home"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('teacher.classroom.setup')}}">
                        <i class="fas fa-school"></i>Classrooms
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('teacher.formBuilder') }}">
                        <i class="fas fa-wpforms"></i>Form Builder
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn user-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-2"></i>{{ Auth::guard('teacher')->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">

                        <li><a class="dropdown-item text-danger" href="{{ route('account.logout') }}"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
