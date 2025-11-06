<form action="{{route('account.login-post')}}" method="POST" class="shortcode-login-form">
    @csrf

    <div class="form-group">
        <input type="email"
               name="email"
               placeholder="Email Address"
               class="form-control @error('email') is-invalid @enderror"
               value="{{old('email')}}"
               required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <input type="password"
               name="password"
               placeholder="Password"
               class="form-control @error('password') is-invalid @enderror"
               required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
</form>

<style>
.shortcode-login-form {
    max-width: 400px;
    margin: 20px 0;
}

.shortcode-login-form .form-group {
    margin-bottom: 0px;
}

.shortcode-login-form .form-control {
    width: 100%;
    padding: 13px 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

.shortcode-login-form .form-control:focus {
    border-color: #0ea5e9;
    outline: none;
    box-shadow: 0 0 5px rgba(14, 165, 233, 0.3);
}

.shortcode-login-form .btn {
    width: 100%;
    padding: 10px;
    background: #0ea5e9;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
}

.shortcode-login-form .btn:hover {
    background: #0284c7;
}

.shortcode-login-form .invalid-feedback {
    color: #ef4444;
    font-size: 12px;
    margin-top: 5px;
}

.shortcode-login-form .form-control.is-invalid {
    border-color: #ef4444;
}
</style>
