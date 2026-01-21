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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="#about" class="nav-link">Tentang</a></li>
                    <li class="nav-item"><a href="#menu" class="nav-link">Menu</a></li>
                    <li class="nav-item"><a href="#pedas" class="nav-link">Level</a></li>
                    <li class="nav-item">
                        <a href="{{ url('/menu') }}" class="nav-link">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="#order" class="nav-link btn btn-primary text-white px-3 ms-2">
                            MENU
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section id="home" class="hero-seblak">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-md-6 text-white">
                    <h1 class="fw-bold display-4">
                        Seblak Pedas <br> Bikin Nagih 🔥
                    </h1>
                    <p class="my-4 text-white-50">
                        Seblak original dengan topping melimpah
                        dan level pedas sesuai selera.
                    </p>
                    <a href="#menu" class="btn btn-warning btn-lg rounded-pill me-3">
                        Lihat Menu
                    </a>
                    <a href="#order" class="btn btn-outline-light btn-lg rounded-pill">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>



    <!-- ABOUT -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4">
                    <img src="{{ asset('Costumer/img/seblak-about.jpg') }}" class="img-fluid rounded-4 shadow">
                </div>
                <div class="col-md-6">
                    <h2 class="fw-bold mb-3">Tentang Seblak Kami</h2>
                    <p>
                        Dibuat dari kerupuk pilihan, bumbu khas,
                        dan cita rasa pedas yang menggugah selera.
                    </p>
                    <p>
                        Cocok untuk kamu yang suka tantangan pedas 🔥
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- MENU -->
    <section id="menu" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Menu Favorit 🌶️</h2>
                <p class="text-muted">Pilihan seblak terbaik untuk kamu</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card menu-card h-100">
                        <img src="assets/img/seblak-original.jpg" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Seblak Original</h5>
                            <p class="text-muted">Kerupuk, telur, sosis</p>
                            <h6 class="text-danger fw-bold">Rp 15.000</h6>
                            <a href="#order" class="btn btn-danger rounded-pill mt-2">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card menu-card h-100">
                        <img src="assets/img/seblak-ceker.jpg" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Seblak Ceker</h5>
                            <p class="text-muted">Ceker empuk & pedas</p>
                            <h6 class="text-danger fw-bold">Rp 18.000</h6>
                            <a href="#order" class="btn btn-danger rounded-pill mt-2">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card menu-card h-100">
                        <img src="assets/img/seblak-komplit.jpg" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Seblak Komplit</h5>
                            <p class="text-muted">Topping super lengkap</p>
                            <h6 class="text-danger fw-bold">Rp 22.000</h6>
                            <a href="#order" class="btn btn-danger rounded-pill mt-2">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- LEVEL PEDAS -->
    <section id="pedas" class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Level Pedas 🌶️</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-2 level-box">🙂<br>Level 1</div>
                <div class="col-md-2 level-box">😋<br>Level 3</div>
                <div class="col-md-2 level-box">😈<br>Level 5</div>
                <div class="col-md-2 level-box">🔥<br>Level 10</div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="order" class="py-5 text-center order-section">
        <div class="container">
            <h2 class="fw-bold text-white mb-3">
                Pesan Sekarang 🔥
            </h2>
            <p class="text-white-50 mb-4">
                Klik tombol di bawah untuk pesan via WhatsApp
            </p>
            <a href="https://wa.me/628xxxxxxxxx" target="_blank" class="btn btn-warning btn-lg rounded-pill">
                <i class="bi bi-whatsapp me-2"></i> Pesan via WhatsApp
            </a>
        </div>
    </section>


    <!-- FOOTER -->
    <footer class="text-white text-center py-4">
        <p class="mb-0">
            © {{ date('Y') }} Seblak Pedas. All Rights Reserved.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
