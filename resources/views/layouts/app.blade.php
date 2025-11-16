<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Green Point Retreats')</title>
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
    <!-- Google Fonts: Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', Arial, sans-serif; }
        .hero-bg {
            background: url('{{ asset('images/halaman.jpg') }}') center/cover no-repeat;
            min-height: 340px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(91, 124, 77, 0.45);
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
            color: #fff;
            text-align: center;
        }
        .main-content { min-height: 60vh; }
        footer {
            background: #4e6b3a;
            color: #fff;
            padding: 32px 0 16px 0;
            margin-top: 48px;
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
        .navbar {
            background: url('{{ asset('images/halaman.jpg') }}') center/cover no-repeat;
            /* Alternatif: ganti dengan Background_2.jpg untuk tampilan berbeda */
            /* background: url('{{ asset('images/Background_2.jpg') }}') center/cover no-repeat; */
            color: #fff; 
            padding: 16px 0;
            position: relative;
        }
        .navbar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(91, 124, 77, 0.8);
            z-index: 1;
        }
        .navbar-content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>
    <nav style="background: #5b7c4d; color: #fff; padding: 16px 0;">
        <div style="max-width:1100px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;">
            <a href="{{ url('/') }}" style="color:#fff; text-decoration:none; font-weight:700; font-size:1.3rem; letter-spacing:1px;">Green Point Retreats</a>
            <div style="display:flex;gap:24px;align-items:center;">
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" style="color:#fff;text-decoration:none;font-weight:500;">Dashboard Admin</a>
                    <form method="POST" action="{{ route('user.logout') }}" style="display:inline;margin:0;">
                        @csrf
                        <button type="submit" style="background:#e57373;border:none;color:#fff;font-weight:600;cursor:pointer;margin-left:18px;padding:7px 18px;border-radius:8px;transition:background 0.2s;box-shadow:0 2px 8px rgba(229,115,115,0.10);font-size:1rem;">Logout</button>
                    </form>
                @elseif(Auth::check() && Auth::user()->role === 'user')
                    <a href="{{ url('/booking') }}" style="color:#fff;text-decoration:none;font-weight:500;">Booking</a>
                    <a href="{{ url('/feedback') }}" style="color:#fff;text-decoration:none;font-weight:500;">Feedback</a>
                    <form method="POST" action="{{ route('user.logout') }}" style="display:inline;margin:0;">
                        @csrf
                        <button type="submit" style="background:#e57373;border:none;color:#fff;font-weight:600;cursor:pointer;margin-left:18px;padding:7px 18px;border-radius:8px;transition:background 0.2s;box-shadow:0 2px 8px rgba(229,115,115,0.10);font-size:1rem;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('user.login') }}" style="color:#fff;text-decoration:none;font-weight:500;">Login</a>
                @endif
            </div>
        </div>
    </nav>
    @if(request()->is('/') || request()->is('home'))
    <div class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 style="font-size:2.8rem;font-weight:700;letter-spacing:1px;">Welcome to Green Point Retreats</h1>
            <p style="font-size:1.3rem;font-weight:400;margin-top:12px;">A Tropical Paradise for Physical, Emotional & Mental Wellness</p>
        </div>
    </div>
    @endif
    <div class="main-content">
        @yield('content')
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