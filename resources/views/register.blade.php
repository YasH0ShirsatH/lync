<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register - Lync</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body class="bg-white">
        <div class="min-vh-100 d-flex align-items-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <h2 class="fw-bold text-dark mb-2">Create Account</h2>
                                    <p class="text-muted">Join us today</p>
                                </div>
                                <form action="{{route('account.register-post')}}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-lg @error('user') is-invalid @enderror" name="user" id="user" value="{{old('user')}}" placeholder="Username">
                                        @error('user')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}" placeholder="Email address">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="confirm_password" placeholder="Confirm Password">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <select class="form-select form-select-lg @error('role') is-invalid @enderror" name="role" id="role">
                                            <option value="" selected disabled>Select your role</option>
                                            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-grid mb-4">
                                        <button class="btn btn-dark btn-lg" type="submit">Create Account</button>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <p class="text-muted mb-0">Already have an account? <a href="{{route('account.login')}}" class="text-dark text-decoration-none fw-semibold">Sign in</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
