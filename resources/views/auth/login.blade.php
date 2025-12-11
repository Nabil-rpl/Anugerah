<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Anugerah Pasim</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
        }

        .login-wrapper {
            display: flex;
            max-width: 1200px;
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
            animation: fadeInScale 0.6s ease;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, rgba(30, 60, 114, 0.9), rgba(42, 82, 152, 0.9));
            padding: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(52, 152, 219, 0.2) 0%, transparent 70%);
            animation: rotateGlow 15s linear infinite;
        }

        @keyframes rotateGlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .brand-image {
            width: 100%;
            max-width: 450px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 1;
            animation: float 3s ease-in-out infinite;
            object-fit: cover;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .login-right {
            flex: 1;
            padding: 80px 60px;
            background: rgba(30, 60, 114, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 40px;
        }

        .login-header h1 {
            color: white;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
            outline: none;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(52, 152, 219, 0.8);
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.2);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn-login {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
            box-shadow: 0 10px 30px rgba(52, 152, 219, 0.4);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(52, 152, 219, 0.5);
        }

        .btn-login:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-login .btn-text {
            display: inline-block;
        }

        .btn-login .spinner {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            margin-left: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
            vertical-align: middle;
        }

        .btn-login.loading .spinner {
            opacity: 1;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .forgot-password {
            text-align: right;
            margin-top: 15px;
        }

        .forgot-password a {
            color: rgba(52, 152, 219, 1);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: rgba(52, 152, 219, 0.8);
        }

        .error-message {
            background: rgba(231, 76, 60, 0.2);
            border-left: 4px solid #e74c3c;
            color: #fff;
            padding: 14px 18px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 14px;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        @media (max-width: 968px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-left {
                padding: 40px 30px;
            }

            .brand-image {
                max-width: 300px;
            }

            .login-right {
                padding: 50px 30px;
            }

            .login-header h1 {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .login-wrapper {
                margin: 10px;
            }

            .login-left {
                padding: 30px 20px;
            }

            .login-right {
                padding: 40px 20px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-left">
            <img src="{{ asset('images/robot.png') }}" 
                 alt="Anugerah Pasim" 
                 class="brand-image">
        </div>

        <div class="login-right">
            <div class="login-header">
                <h1>Anugerah Pasim</h1>
                <p>Silakan login untuk melanjutkan</p>
            </div>

            <form action="{{ route('login.process') }}" method="POST" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="nama@example.com"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••"
                        required
                    >
                </div>

                <button type="submit" class="btn-login" id="loginBtn">
                    <span class="btn-text">Login</span>
                    <span class="spinner"></span>
                </button>

                <div class="forgot-password">
                    <a href="#">Lupa Password?</a>
                </div>

                @error('email')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </form>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');

        loginForm.addEventListener('submit', function(e) {
            // Tampilkan loading spinner di button
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;
        });

        // Reset loading state jika ada error (halaman reload dengan error)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                loginBtn.classList.remove('loading');
                loginBtn.disabled = false;
            }
        });
    </script>
</body>
</html>