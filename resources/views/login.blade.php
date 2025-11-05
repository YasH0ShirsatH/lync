<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Lync</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            * {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

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
                --danger-50: #fef2f2;
                --danger-500: #ef4444;
                --white: #ffffff;
            }

            body {
                background: linear-gradient(135deg, var(--gray-50) 0%, var(--primary-50) 100%);
                min-height: 100vh;
                color: var(--gray-800);
            }

            .login-container {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 1rem;
            }

            .login-card {
                background: var(--white);
                border: 1px solid var(--gray-200);
                border-radius: 1rem;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                overflow: hidden;
                max-width: 400px;
                width: 100%;
            }

            .login-header {
                background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
                padding: 2rem;
                text-align: center;
                position: relative;
            }

            .login-header::after {
                content: '';
                position: absolute;
                bottom: -1px;
                left: 0;
                right: 0;
                height: 1px;
                background: var(--gray-200);
            }

            .brand-logo {
                width: 3rem;
                height: 3rem;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                backdrop-filter: blur(10px);
            }

            .brand-logo i {
                color: white;
                font-size: 1.5rem;
            }

            .login-title {
                color: white;
                font-size: 1.75rem;
                font-weight: 700;
                margin: 0 0 0.5rem 0;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            }

            .login-subtitle {
                color: rgba(255, 255, 255, 0.9);
                font-size: 1rem;
                margin: 0;
                opacity: 0.95;
            }

            .login-body {
                padding: 2rem;
            }

            .form-floating {
                margin-bottom: 1.5rem;
            }

            .form-floating > .form-control {
                background: var(--gray-50);
                border: 1px solid var(--gray-300);
                border-radius: 0.5rem;
                padding: 1rem 0.75rem;
                font-size: 0.875rem;
                transition: all 0.2s ease;
            }

            .form-floating > .form-control:focus {
                background: var(--white);
                border-color: var(--primary-500);
                box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
                outline: none;
            }

            .form-floating > label {
                color: var(--gray-500);
                font-size: 0.875rem;
                font-weight: 500;
            }

            .form-control.is-invalid {
                border-color: var(--danger-500);
                background: var(--danger-50);
            }

            .invalid-feedback {
                color: var(--danger-500);
                font-size: 0.75rem;
                font-weight: 500;
                margin-top: 0.5rem;
            }

            .btn-login {
                background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
                border: none;
                border-radius: 0.5rem;
                color: white;
                font-weight: 600;
                padding: 0.875rem 1.5rem;
                font-size: 0.875rem;
                transition: all 0.2s ease;
                width: 100%;
                position: relative;
                overflow: hidden;
            }

            .btn-login:hover {
                transform: translateY(-1px);
                box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.3);
                color: white;
            }

            .btn-login:active {
                transform: translateY(0);
            }

            .btn-login:disabled {
                opacity: 0.6;
                cursor: not-allowed;
                transform: none;
            }

            .login-footer {
                text-align: center;
                padding-top: 1.5rem;
                border-top: 1px solid var(--gray-200);
            }

            .register-link {
                color: var(--primary-600);
                text-decoration: none;
                font-weight: 600;
                transition: color 0.2s ease;
            }

            .register-link:hover {
                color: var(--primary-700);
                text-decoration: underline;
            }

            .alert {
                border: none;
                border-radius: 0.5rem;
                padding: 1rem;
                margin-bottom: 1.5rem;
                font-size: 0.875rem;
                font-weight: 500;
            }

            .alert-success {
                background: var(--success-50);
                color: var(--success-500);
                border-left: 4px solid var(--success-500);
            }

            .alert-danger {
                background: var(--danger-50);
                color: var(--danger-500);
                border-left: 4px solid var(--danger-500);
            }

            .btn-close {
                font-size: 0.75rem;
            }

            .loading-spinner {
                display: none;
                width: 1rem;
                height: 1rem;
                border: 2px solid transparent;
                border-top: 2px solid white;
                border-radius: 50%;
                animation: spin 1s linear infinite;
                margin-right: 0.5rem;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .form-floating > .form-control:not(:placeholder-shown) {
                padding-top: 1.625rem;
                padding-bottom: 0.625rem;
            }

            .form-floating > .form-control:focus,
            .form-floating > .form-control:not(:placeholder-shown) {
                padding-top: 1.625rem;
                padding-bottom: 0.625rem;
            }

            .form-floating > label {
                opacity: 0.65;
            }

            .form-floating > .form-control:focus ~ label,
            .form-floating > .form-control:not(:placeholder-shown) ~ label {
                opacity: 0.65;
                transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
            }

            @media (max-width: 576px) {
                .login-container {
                    padding: 1rem;
                }
                
                .login-body {
                    padding: 1.5rem;
                }
                
                .login-header {
                    padding: 1.5rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-card">
                <!-- Login Header -->
                <div class="login-header">
                    <div class="brand-logo">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h1 class="login-title">Welcome Back</h1>
                    <p class="login-subtitle">Sign in to your Lync account</p>
                </div>

                <!-- Login Body -->
                <div class="login-body">
                    <!-- Alert Messages -->
                    @session('success')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endsession
                    @session('error')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endsession

                    <!-- Login Form -->
                    <form action="{{route('account.login-post')}}" method="POST" id="loginForm">
                        @csrf

                        <div class="form-floating">
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   id="email" 
                                   value="{{old('email')}}" 
                                   placeholder="name@example.com"
                                   required>
                            <label for="email">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   id="password" 
                                   placeholder="Password"
                                   required>
                            <label for="password">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-login" id="loginBtn">
                            <span class="loading-spinner" id="loadingSpinner"></span>
                            <i class="fas fa-sign-in-alt me-2" id="loginIcon"></i>
                            <span id="loginText">Sign In</span>
                        </button>
                    </form>

                    <!-- Login Footer -->
                    <div class="login-footer">
                        <p class="text-muted mb-0">
                            Don't have an account? 
                            <a href="/account/register" class="register-link">
                                Create one
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loginForm = document.getElementById('loginForm');
                const loginBtn = document.getElementById('loginBtn');
                const loginText = document.getElementById('loginText');
                const loginIcon = document.getElementById('loginIcon');
                const loadingSpinner = document.getElementById('loadingSpinner');

                // Form submission with loading state
                loginForm.addEventListener('submit', function(e) {
                    loginBtn.disabled = true;
                    loginText.textContent = 'Signing In...';
                    loginIcon.style.display = 'none';
                    loadingSpinner.style.display = 'inline-block';
                });

                // Input focus effects
                const inputs = document.querySelectorAll('.form-control');
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('focused');
                    });
                    
                    input.addEventListener('blur', function() {
                        this.parentElement.classList.remove('focused');
                    });
                });

                // Auto-dismiss alerts after 5 seconds
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    setTimeout(() => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }, 5000);
                });
            });
        </script>
    </body>
</html>
