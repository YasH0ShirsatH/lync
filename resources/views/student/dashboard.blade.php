<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <div class="container">
                        <a class="navbar-brand" href="#">Student Dashboard</a>
                        <div class="navbar-nav ms-auto">
                            <span class="navbar-text me-3">Welcome, {{ Auth::guard('student')->user()->name }}</span>
                            <a class="btn btn-outline-light btn-sm" href="{{route('account.logout')}}">Logout</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="container">
                    <h2>Student Dashboard</h2>
                    <p class="text-muted">Access your courses and assignments</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
