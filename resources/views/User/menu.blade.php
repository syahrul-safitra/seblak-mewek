@extends("User.Layouts.main")

@section("container")
    <section id="menu" class="bg-light" style="padding-top: 120px; padding-bottom: 70px">
        <div class="container">

            <!-- Section Title -->
            <div class="mb-5 text-center">
                <h2 class="fw-bold text-danger">Menu Seblak</h2>
                <p class="text-muted">
                    Pilih seblak favoritmu dengan berbagai topping lezat 🔥
                </p>
            </div>

            <!-- Menu List -->
            <div class="row g-4">

                <!-- ITEM -->
                @foreach ($products as $product)
                    <div class="col-md-4 col-lg-3">
                        <div class="card menu-card h-100 shadow-sm">
                            <img src="{{ asset("uploads/produk/" . $product->gambar) }}" class="card-img-top"
                                alt="Seblak Original">

                            <div class="card-body text-center">
                                <h6 class="fw-bold">{{ $product->nama }}</h6>
                                <p class="text-muted small mb-2">
                                    {{ \Illuminate\Support\Str::limit($product->deskripsi, 50) }}
                                </p>

                                <h6 class="text-danger fw-bold">
                                    Rp 15.000
                                </h6>
                            </div>

                            <div class="card-footer border-0 bg-white text-center">
                                <a href="{{ url("/order/" . $product->id) }}" class="btn btn-outline-danger btn-sm w-100">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
