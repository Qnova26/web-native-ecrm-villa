<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
    <style>
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: url('{{ asset('images/halaman.jpg') }}') center/cover no-repeat fixed;
            position: relative;
        }
        .bg-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(91, 124, 77, 0.45);
            z-index: 0;
        }
        .main-content {
            min-height: calc(100vh - 180px);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        .register-card {
            max-width: 340px;
            margin: 40px auto;
            padding: 32px 32px 32px 32px;
            background: #f8f8f8;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            position: relative;
            z-index: 2;
        }
        .register-card h2 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 24px;
        }
        .register-card label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
        }
        .register-card label:first-of-type {
            margin-top: 0;
        }
        .register-card label:not(:first-of-type) {
            margin-top: 14px;
        }
        .register-card input[type="text"],
        .register-card input[type="email"],
        .register-card input[type="password"] {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 14px;
            border-radius: 7px;
            border: 1.5px solid #bbb;
            margin-bottom: 0;
            font-size: 1rem;
            transition: border 0.2s;
            background: #f9f9f9;
        }
        .register-card input[type="password"] {
            margin-bottom: 0;
        }
        .register-card input[type="text"]:focus,
        .register-card input[type="email"]:focus,
        .register-card input[type="password"]:focus {
            border: 1.5px solid #5b7c4d;
            outline: none;
            background: #fff;
        }
        .register-card button {
            width: 100%;
            background: #5b7c4d;
            color: #fff;
            font-weight: 600;
            padding: 12px 0;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            margin-top: 18px;
        }
        .register-card .error {
            color: #e57373;
            margin-bottom: 18px;
            text-align: center;
        }
        .register-card .login-link {
            text-align: center;
            margin-top: 18px;
            font-size: 0.95rem;
        }
        .register-card .login-link a {
            color: #5b7c4d;
            text-decoration: none;
            font-weight: 600;
        }
        footer {
            background: #4e6b3a;
            color: #fff;
            padding: 32px 0 16px 0;
            margin-top: 48px;
            position: relative;
            z-index: 2;
        }
        .footer-content {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 32px;
        }
        .footer-section { min-width: 180px; }
        .footer-social a {
            color: #fff;
            margin-right: 12px;
            font-size: 1.3rem;
            text-decoration: none;
        }
        @media (max-width: 700px) {
            .footer-content { flex-direction: column; gap: 16px; }
            .footer-section { min-width: 0; }
        }
    </style>
</head>
<body>
    <div class="bg-overlay"></div>
    <nav style="background: #5b7c4d; color: #fff; padding: 16px 0; position: relative; z-index: 2;">
        <div style="max-width:1100px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;">
            <a href="{{ url('/') }}" style="color:#fff; text-decoration:none; font-weight:700; font-size:1.3rem; letter-spacing:1px;">Green Point Retreats</a>
            <div style="display:flex;gap:24px;align-items:center;">
                <a href="{{ url('/') }}" style="color:#fff;text-decoration:none;font-weight:500;">Home</a>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <div class="register-card">
            <h2>Register User</h2>
            @if($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif
            <form method="POST" action="{{ url('/register') }}">
                @csrf
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                <button type="submit">Register</button>
            </form>
            <div class="login-link">
                Sudah punya akun? <a href="{{ route('user.login') }}">Login di sini</a>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <strong>Green Point Retreats</strong><br>
                Br, Jl. Tegal Temu Kelod, Tibubiu, Kec. Kerambitan, Kabupaten Tabanan<br>
                Email: info@greenpointretreats.com<br>
                Telp: +62 812-3456-7890
            </div>
            <div class="footer-section">
                <strong>Business Hours</strong><br>
                Mon-Fri: 8am - 8pm<br>
                Sat-Sun: 8am - 4pm
            </div>
            <div class="footer-section footer-social">
                <strong>Get Social</strong><br>
                <a href="#"><span style="font-size:1.2em;">&#x1F30E;</span> IG</a>
                <a href="#"><span style="font-size:1.2em;">&#x1F426;</span> FB</a>
                <a href="#"><span style="font-size:1.2em;">&#x1F4F1;</span> WA</a>
            </div>
        </div>
        <div style="text-align:center;margin-top:18px;font-size:0.95rem;opacity:0.7;">&copy; {{ date('Y') }} Green Point Retreats. All rights reserved.</div>
    </footer>
</body>
</html> 