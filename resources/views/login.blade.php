<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Lync</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body class="bg-white">
        <div class="min-vh-100 d-flex align-items-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                        @session('success')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession
                        @session('error')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <h2 class="fw-bold text-dark mb-2">Welcome Back</h2>
                                    <p class="text-muted">Sign in to your account</p>
                                </div>
                                <form action="{{route('account.login-post')}}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}" placeholder="Email address">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-grid mb-4">
                                        <button class="btn btn-dark btn-lg" type="submit">Sign In</button>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <p class="text-muted mb-0">Don't have an account? <a href="/account/register" class="text-dark text-decoration-none fw-semibold">Create one</a></p>
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
