<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login | Riya Fashion — Surat</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --rf-navy: #0b1329;
            --rf-navy-light: #16203d;
            --rf-gold: #c59b27;
            --rf-gold-light: #dfb743;
            --rf-gold-subtle: rgba(197, 155, 39, 0.15);
            --rf-slate: #64748b;
            --rf-card-bg: #ffffff;
            --rf-body-bg: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 10% 20%, #1e293b 0%, #0b1329 90%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            color: #f8fafc;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: -150px;
            right: -150px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(197, 155, 39, 0.12) 0%, rgba(197, 155, 39, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .login-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            color: #1e293b;
            position: relative;
        }

        .login-card-header {
            background: linear-gradient(135deg, #0b1329 0%, #1a274c 100%);
            padding: 32px 28px 26px;
            text-align: center;
            border-bottom: 3px solid var(--rf-gold);
            position: relative;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            background: rgba(197, 155, 39, 0.15);
            border: 1px solid var(--rf-gold);
            border-radius: 14px;
            margin-bottom: 14px;
            color: var(--rf-gold);
            font-size: 26px;
        }

        .brand-title {
            font-family: 'Cinzel', serif;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .brand-subtitle {
            font-size: 13px;
            color: #94a3b8;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .login-card-body {
            padding: 32px 28px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .input-group-text {
            background-color: #f8fafc;
            border-color: #e2e8f0;
            color: #64748b;
        }

        .form-control {
            border-color: #e2e8f0;
            font-size: 14px;
            padding: 10px 14px;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: var(--rf-gold);
            box-shadow: 0 0 0 3px rgba(197, 155, 39, 0.2);
        }

        .btn-gold {
            background: linear-gradient(135deg, #c59b27 0%, #b38918 100%);
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 12px 18px;
            border-radius: 8px;
            transition: all 0.25s ease;
            letter-spacing: 0.5px;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #dfb743 0%, #c59b27 100%);
            transform: translateY(-1px);
            box-shadow: 0 8px 16px -4px rgba(197, 155, 39, 0.35);
            color: #ffffff;
        }

        .password-toggle {
            cursor: pointer;
            background-color: #f8fafc;
            border-color: #e2e8f0;
            color: #64748b;
        }

        .password-toggle:hover {
            color: var(--rf-gold);
        }

        .footer-note {
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- Header -->
        <div class="login-card-header">
            <div class="brand-badge">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h1 class="brand-title">RIYA FASHION</h1>
            <p class="brand-subtitle mb-0">Admin Management Portal • Surat, Gujarat</p>
        </div>

        <!-- Body -->
        <div class="login-card-body">

            <!-- Flash Alerts -->
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div class="small">{{ session('success') }}</div>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning d-flex align-items-center py-2 px-3 mb-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div class="small">{{ session('warning') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center py-2 px-3 mb-3" role="alert">
                    <i class="bi bi-x-circle-fill me-2"></i>
                    <div class="small">{{ session('error') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger py-2 px-3 mb-3" role="alert">
                    <ul class="mb-0 ps-3 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" autocomplete="off">
                @csrf

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Administrator Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               placeholder="admin@riyafashion.com" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="••••••••" 
                               required>
                        <span class="input-group-text password-toggle" id="togglePasswordBtn" title="Show/Hide Password">
                            <i class="bi bi-eye" id="togglePasswordIcon"></i>
                        </span>
                    </div>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label small text-muted" for="remember">
                            Remember this browser
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-gold w-100 py-2">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Sign In to Dashboard
                </button>
            </form>

            <!-- Back to website link -->
            <div class="text-center mt-3">
                <a href="{{ url('/') }}" class="text-decoration-none small text-muted">
                    <i class="bi bi-arrow-left me-1"></i> Return to Main Website
                </a>
            </div>

        </div>
    </div>

    <!-- Script for password visibility toggle -->
    <script>
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                toggleIcon.classList.toggle('bi-eye', !isPassword);
                toggleIcon.classList.toggle('bi-eye-slash', isPassword);
            });
        }
    </script>
</body>
</html>
