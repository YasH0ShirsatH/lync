<form action="{{route('account.register-post')}}" method="POST" class="shortcode-register-form">
    @csrf

    <div class="form-group">
        <input type="text" 
               name="user" 
               placeholder="Username"
               class="form-control @error('user') is-invalid @enderror"
               value="{{old('user')}}" 
               required>
        @error('user')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

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

    <div class="form-group">
        <input type="password" 
               name="password_confirmation" 
               placeholder="Confirm Password"
               class="form-control @error('password_confirmation') is-invalid @enderror"
               required>
        @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <select name="role" class="form-control @error('role') is-invalid @enderror" required>
            <option value="" disabled selected>Select your role</option>
            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
        </select>
        @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create Account</button>
</form>

<style>
.shortcode-register-form {
    max-width: 350px;
    margin: 20px 0;
}

.shortcode-register-form .form-group {
    margin-bottom: 15px;
}

.shortcode-register-form .form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

.shortcode-register-form .form-control:focus {
    border-color: #0ea5e9;
    outline: none;
    box-shadow: 0 0 5px rgba(14, 165, 233, 0.3);
}

.shortcode-register-form select.form-control {
    background: white;
    cursor: pointer;
}

.shortcode-register-form .btn {
    width: 100%;
    padding: 12px;
    background: #0ea5e9;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
    font-size: 16px;
}

.shortcode-register-form .btn:hover {
    background: #0284c7;
}

.shortcode-register-form .invalid-feedback {
    color: #ef4444;
    font-size: 12px;
    margin-top: 5px;
}

.shortcode-register-form .form-control.is-invalid {
    border-color: #ef4444;
}
</style>