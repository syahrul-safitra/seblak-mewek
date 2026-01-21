@extends("User.Layouts.main")

@section("title", "Order Seblak")

@section("container")
    <div class="container" style="padding-top: 120px; padding-bottom: 70px">
        <div class="row g-4 justify-content-center">

            <!-- GAMBAR -->
            <div class="col-md-5">
                <img src="{{ asset("uploads/produk/" . $menu->gambar) }}" class="img-fluid rounded shadow"
                    alt="{{ $menu->nama }}">
            </div>

            <!-- FORM ORDER -->
            <div class="col-md-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        <h4 class="fw-bold">{{ $menu->nama }}</h4>

                        <p class="text-muted small">
                            {{ $menu->deskripsi }}
                        </p>

                        <h5 class="text-danger fw-bold mb-3">
                            Rp {{ number_format($menu->harga, 0, ",", ".") }}
                        </h5>

                        <form action="{{ url("/order") }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $menu->id }}">
                            <input type="hidden" name="customer_id" value="1">
                            <input type="hidden" id="harga" value="{{ $menu->harga }}">

                            <input type="number" name="jumlah" id="qty" class="form-control" min="1"
                                value="1" max="{{ $menu->jumlah }}">

                            <div class="mb-3">
                                <label class="form-label">Level Pedas 🌶️</label>
                                <select name="level_pedas" class="form-select">
                                    <option value="1">Level 1 (Santai)</option>
                                    <option value="2">Level 2</option>
                                    <option value="3">Level 3</option>
                                    <option value="4">Level 4</option>
                                    <option value="5">Level 5 (Nangis)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control" placeholder="Contoh: tidak pakai ceker"></textarea>
                            </div>

                            <div class="mb-3">
                                <h6 class="d-flex justify-content-between">
                                    <span>Total Harga</span>
                                    <span class="fw-bold text-danger" id="totalHarga">
                                        Rp {{ number_format($menu->harga, 0, ",", ".") }}
                                    </span>
                                </h6>
                            </div>

                            <button class="btn btn-primary w-100">
                                Pesan Sekarang
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const harga = parseInt(document.getElementById('harga').value);
        const qtyInput = document.getElementById('qty');
        const totalHarga = document.getElementById('totalHarga');

        function updateTotal() {
            let qty = parseInt(qtyInput.value) || 1;
            let total = harga * qty;

            totalHarga.innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        qtyInput.addEventListener('input', updateTotal);
    </script>

@endsection
