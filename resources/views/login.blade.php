<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mascot Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===== Base Page Setup ===== */
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: "Poppins", sans-serif;
            background: radial-gradient(circle at top left, #ff6ec4, #7873f5, #00c6ff, #f7971e);
            background-size: 400% 400%;
            animation: rainbowShift 12s ease infinite;
            overflow: hidden;
            color: #fff;
            position: relative;
        }

        /* Subtle floating shapes (optional aesthetic) */
        body::before, body::after {
            content: "";
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            animation: floaty 10s ease-in-out infinite;
            z-index: 0;
        }
        body::before {
            top: 10%;
            left: -100px;
            animation-delay: 0s;
        }
        body::after {
            bottom: -100px;
            right: -100px;
            animation-delay: 5s;
        }

        @keyframes floaty {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.1); }
        }

        @keyframes rainbowShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ===== Left Text Section ===== */
        .left-section {
            flex: 1;
            padding-left: 5%;
            z-index: 1;
            animation: fadeInLeft 1.2s ease;
        }

        .left-section h1 {
            font-weight: 700;
            font-size: 2.8rem;
            line-height: 1.3;
        }

        .left-section p {
            font-size: 1.1rem;
            max-width: 500px;
            margin-top: 1rem;
            color: rgba(255,255,255,0.9);
        }

        @keyframes fadeInLeft {
            from { transform: translateX(-50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* ===== Login Card ===== */
        .login-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            margin-right: 6%;
            z-index: 2;
            animation: slideInRight 1s ease-out;
        }

        @keyframes slideInRight {
            from { transform: translateX(60px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .brand-text {
            font-size: 1.25rem;
            font-weight: 600;
            color: #6610f2;
        }

        .login-title {
            font-weight: 700;
            color: #222;
        }

        .form-control:focus {
            border-color: #6610f2;
            box-shadow: 0 0 0 0.25rem rgba(102, 16, 242, 0.25);
        }

        .btn-primary {
            background: linear-gradient(90deg, #007bff, #6610f2);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            background: linear-gradient(90deg, #6610f2, #007bff);
        }

        .footer-text {
            font-size: 0.9rem;
            color: #555;
        }

        /* ===== Responsive ===== */
        @media (max-width: 992px) {
            body {
                flex-direction: column;
                justify-content: center;
                text-align: center;
                background-size: 600% 600%;
            }
            .left-section {
                padding: 2rem;
            }
            .login-card {
                margin: 1.5rem auto;
            }
        }
    </style>
</head>
<body>
    <!-- LEFT SECTION -->
    <div class="left-section">
        <h1>Welcome to <span class="text-warning">Mascot</span> Education Portal</h1>
        <p>
            A smart, dynamic platform for managing education seamlessly.  
            Track attendance, monitor performance, manage finances — all at one place.
        </p>
    </div>

    <!-- LOGIN CARD -->
    <div class="login-card">
        <div class="text-center mb-4">
            <div class="brand-text">🎓 Mascot System</div>
            <h4 class="login-title mt-2">Welcome Back!</h4>
            <p class="text-muted">Login to your dashboard</p>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger text-center py-2">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control form-control-lg"
                       placeholder="Enter your email" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control form-control-lg"
                       placeholder="Enter your password" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </button>
            </div>
        </form>

        <div class="text-center mt-4 footer-text">
            <p>© {{ date('Y') }} Mascot Education Management System</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
</body>
</html>
