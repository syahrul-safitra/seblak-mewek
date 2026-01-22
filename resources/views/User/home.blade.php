@extends('User.Layouts.main')

<style>
    .menu-card img {
        height: 180px;
        object-fit: cover;
    }

    .menu-card:hover {
        transform: translateY(-5px);
        transition: 0.3s ease;
    }
</style>

@section('container')
    <!-- HERO -->
    <section id="home" class="hero-seblak">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-md-6 text-white">
                    <h1 class="fw-bold display-4">
                        Seblak Pedas <br> Bikin Nagih 🔥
                    </h1>
                    <p class="text-white-50 my-4">
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
                    <img src="{{ asset('Costumer/img/logo.png') }}" class="img-fluid rounded-4 shadow">
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
    <section id="menu" class="bg-light py-5">
        <div class="container">
            <div class="mb-5 text-center">
                <h2 class="fw-bold">Menu Favorit 🌶️</h2>
                <p class="text-muted">Pilihan seblak terbaik untuk kamu</p>
            </div>

            <div class="row g-4">

                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card menu-card h-100">
                            <img src="{{ asset('uploads/produk/' . $product->gambar) }}" class="card-img-top"
                                alt="">
                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ $product->nama }}</h5>
                                <p class="text-muted small mb-2">
                                    {{ \Illuminate\Support\Str::limit($product->deskripsi, 50) }}
                                </p>

                                <h6 class="text-danger fw-bold">{{ number_format($product->harga, 0, ',', '.') }}
                                </h6>
                                <a href="#order" class="btn btn-danger rounded-pill mt-2">
                                    Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

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
@endsection
