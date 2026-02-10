    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>Seblak Pedas 🔥</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">

        <style>
            :root {
                --primary: #e63946;
                --secondary: #f77f00;
                --dark: #1c1c1c;
            }

            body {
                font-family: 'Poppins', sans-serif;
            }

            /* HERO */
            .hero-seblak {
                position: relative;
                min-height: 100vh;
                background-image: url({{ asset('Costumer/img/gambar_seblak.png') }});
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

            /* Overlay agar teks jelas */
            .hero-seblak::before {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(90deg,
                        rgba(160, 20, 40, 0.65),
                        rgba(0, 0, 0, 0.35));
            }

            .hero-seblak>.container {
                position: relative;
                z-index: 2;
            }

            @keyframes float {
                0% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }

                100% {
                    transform: translateY(0);
                }
            }

            /* BUTTON */
            .btn-primary {
                background: linear-gradient(45deg, var(--primary), var(--secondary));
                border: none;
            }

            .btn-primary:hover {
                opacity: .9;
            }

            /* MENU CARD */
            .menu-card {
                border: none;
                border-radius: 20px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, .1);
                transition: 0.3s;
            }

            .menu-card:hover {
                transform: translateY(-10px);
            }

            /* BADGE */
            .badge-pedas {
                background: var(--primary);
            }

            /* LEVEL */
            .level-box {
                border-radius: 16px;
                padding: 20px;
                background: #fff;
                box-shadow: 0 8px 30px rgba(0, 0, 0, .08);
                transition: .3s;
            }

            /* Navbar awal (transparan) */
            .navbar-custom {
                transition: all 0.3s ease;
                background: transparent;
            }

            /* Navbar setelah scroll */
            .navbar-custom.scrolled {
                background: #b11226;
                /* merah seblak */
                box-shadow: 0 4px 20px rgba(0, 0, 0, .2);
            }

            /* Hover nav-link */
            .navbar .nav-link {
                position: relative;
                font-weight: 500;
            }

            .navbar .nav-link:hover {
                color: #ffd166 !important;
            }

            /* Tombol Pesan */
            .navbar .btn.nav-link {
                border-radius: 30px;
                transition: 0.3s;
            }

            .navbar .btn.nav-link:hover {
                background: #ffd166;
                color: #000 !important;
            }

            .level-box:hover {
                transform: scale(1.05);
            }

            .order-section {
                background: linear-gradient(135deg, #b11226, #ff3c3c);
            }

            footer {
                background: var(--dark);
            }

            .transition-social {
                display: inline-block;
                transition: transform 0.3s ease, color 0.3s ease;
                text-decoration: none;
            }

            .transition-social:hover {
                color: #ffd166 !important;
                /* Warna kuning saat hover */
                transform: translateY(-5px);
                /* Efek melompat sedikit */
            }
        </style>
    </head>

    <body>

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark bg-opacity-75">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">
                    🌶️ SEBLAK MEWEK
                </a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a href="{{ url('/#about') }}" class="nav-link">Tentang</a></li>
                        <li class="nav-item"><a href="{{ url('/#menu') }}" class="nav-link">Menu</a></li>
                        <li class="nav-item"><a href="{{ url('/#pedas') }}" class="nav-link">Level</a></li>
                        <li class="nav-item">
                            <a href="{{ url('/menu') }}" class="nav-link">Semua Menu</a>
                        </li>

                        @if (Auth::guard('customer')->check())
                            <li>
                                <a href="{{ url('/profile') }}" class="nav-link">Profile</a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ url('logout') }}" method="post">
                                    @csrf
                                    <button class="nav-link btn btn-primary ms-2 px-3 text-white">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @endif

                        @if (!Auth::guard('customer')->check())
                            <li class="nav-item">
                                <a href="{{ url('/login') }}" class="nav-link btn btn-primary ms-2 px-3 text-white">
                                    Login
                                </a>
                            </li>
                        @endif


                    </ul>
                </div>
            </div>
        </nav>

        @yield('container')

        <!-- CTA -->
        <section id="order" class="order-section py-5 text-center">
            <div class="container">
                <h2 class="fw-bold mb-3 text-white">
                    Pesan Sekarang 🔥
                </h2>
                <p class="text-white-50 mb-4">
                    Klik tombol di bawah untuk pesan via WhatsApp
                </p>
                <a href="{{ url('https://wa.me/' . $no_wa->no_wa) }}" target="_blank"
                    class="btn btn-warning btn-lg rounded-pill">
                    <i class="bi bi-whatsapp me-2"></i> Pesan via WhatsApp
                </a>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="py-4 text-center text-white">
            <footer class="py-5 text-center text-white">
                <div class="container">
                    <div class="mb-4">
                        <a href="#" class="text-white mx-3 fs-4 transition-social"><i
                                class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white mx-3 fs-4 transition-social"><i
                                class="bi bi-tiktok"></i></a>
                        <a href="#" class="text-white mx-3 fs-4 transition-social"><i
                                class="bi bi-facebook"></i></a>
                        <a href="https://wa.me/{{ $no_wa->no_wa }}" class="text-white mx-3 fs-4 transition-social"><i
                                class="bi bi-whatsapp"></i></a>
                    </div>

                    <p class="mb-0 text-white-50">
                        &copy; {{ date('Y') }} Seblak Mewek. All Rights Reserved.
                    </p>
                </div>
            </footer>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
