<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Point Retreats | Villa & Resort</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Georgia:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>
    @if(session('success'))
        <div style="max-width:400px;margin:24px auto 0 auto;background:#e6f4ea;color:#256029;padding:14px 24px;border-radius:8px;text-align:center;font-weight:600;box-shadow:0 2px 8px rgba(91,124,77,0.08);">
            {{ session('success') }}
        </div>
    @endif
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ url('/') }}" class="navbar-brand">Green Point Retreats</a>
            <ul class="navbar-menu">
                <li><a href="#rooms">Kamar</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#contact">Kontak</a></li>
                @if(Auth::check() && Auth::user()->role === 'user')
                    <li><a href="{{ url('/feedback') }}">Feedback</a></li>
                @endif
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" class="btn-booking">Dashboard Admin</a></li>
                @elseif(Auth::check() && Auth::user()->role === 'user')
                    <li><a href="{{ url('/booking') }}" class="btn-booking">Booking</a></li>
                @else
                    <li><a href="{{ route('user.login') }}" class="btn-booking">Login</a></li>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Selamat Datang di Green Point Retreats</h1>
            <p>Villa tropis untuk relaksasi fisik, emosional, dan mental. Nikmati kemewahan, kenyamanan, dan keindahan alam Bali.</p>
            <a 
                @if(Auth::check() && Auth::user()->role === 'admin')
                    href="{{ route('admin.dashboard') }}"
                @elseif(Auth::check() && Auth::user()->role === 'user')
                    href="{{ url('/booking') }}"
                @else
                    href="{{ route('user.login') }}"
                @endif
                class="btn-main">Booking Sekarang</a>
        </div>
    </header>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="about-content">
            <h2>Mengapa Memilih Kami?</h2>
            <p>
                Green Point Retreats menawarkan pengalaman menginap di villa dengan fasilitas lengkap, pemandangan alam yang asri, dan layanan ramah. Cocok untuk liburan keluarga, pasangan, maupun retret pribadi.
            </p>
            <ul class="about-features">
                <li>✔️ Kamar Suite & Deluxe</li>
                <li>✔️ Kolam Renang & Spa</li>
                <li>✔️ Restoran Organik</li>
                <li>✔️ Yoga & Wellness</li>
                <li>✔️ Lokasi Strategis di Tabanan, Bali</li>
            </ul>
        </div>
        <div class="about-image">
            <img src="{{ asset('images/gambarvilla.jpg') }}" alt="Villa Green Point" />
        </div>
    </section>

    <!-- Rooms Section -->
    <section class="rooms" id="rooms">
        <h2>Pilihan Kamar</h2>
        <div class="rooms-grid">
            <div class="room-card">
                <img src="{{ asset('images/Kamar_1.jpeg') }}" alt="Deluxe Double Room with Balcony and Sea View">
                <div class="room-info">
                    <h3>Deluxe Double Room with Balcony and Sea View</h3>
                    <p>Kamar luas dengan balkon pribadi, pemandangan taman, dan bathtub mewah.</p>
                    <div class="room-price">Rp 809.250 / malam</div>
                </div>
            </div>
            <div class="room-card">
                <img src="{{ asset('images/Kamar_2.jpeg') }}" alt="Deluxe Bungalow with Sea View">
                <div class="room-info">
                    <h3>Deluxe Bungalow with Sea View</h3>
                    <p>Kamar elegan dengan king bed, akses langsung ke kolam renang, dan fasilitas premium.</p>
                    <div class="room-price">Rp 1.052.025 / malam</div>
                </div>
            </div>
            <div class="room-card">
                <img src="{{ asset('images/Kamar_3.jpeg') }}" alt="Two-Bedroom Townhouse">
                <div class="room-info">
                    <h3>Two-Bedroom Townhouse</h3>
                    <p>Kamar keluarga dengan dua kamar tidur, ruang tamu, dan dapur mini.</p>
                    <div class="room-price">Rp 1.456.650 / malam</div>
                </div>
            </div>
        </div>
        <div class="center">
            <a 
                @if(Auth::check() && Auth::user()->role === 'admin')
                    href="{{ route('admin.dashboard') }}"
                @elseif(Auth::check() && Auth::user()->role === 'user')
                    href="{{ url('/booking') }}"
                @else
                    href="{{ route('user.login') }}"
                @endif
                class="btn-main">Pesan Kamar</a>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="contact-info">
            <h2>Kontak & Lokasi</h2>
            <p>
                Br, Jl. Tegal Temu Kelod, Tibubiu, Kec. Kerambitan, Kabupaten Tabanan, Bali<br>
                Email: info@greenpointretreats.com<br>
                Telp: +62 812-3456-7890
            </p>
            <div class="contact-social">
                <a href="#"><span>🌐</span> Instagram</a>
                <a href="#"><span>📘</span> Facebook</a>
                <a href="#"><span>📱</span> WhatsApp</a>
            </div>
        </div>
        <div class="contact-map">
            <iframe src="https://www.google.com/maps?q=Tabanan+Bali&output=embed" frameborder="0" allowfullscreen></iframe>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            &copy; {{ date('Y') }} Green Point Retreats. All rights reserved.
        </div>
    </footer>
</body>
</html>
