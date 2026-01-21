@extends("Admin.Layouts.main")

@section("title", "Tambah Produk")

@section("container")
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h5 class="mb-4">
                        <i class="bi bi-plus-circle text-danger me-2"></i>
                        Tambah Produk Seblak
                    </h5>

                    <form action="{{ url("product") }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">

                            <!-- NAMA -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control @error("nama") is-invalid @enderror"
                                    name="nama" value="{{ old("nama") }}" placeholder="Contoh: Seblak Ceker" autofocus>
                                @error("nama")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- KATEGORI -->
                            {{-- <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" class="form-select @error("kategori") is-invalid @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="tidak pedas" {{ old('kategori') == 'tidak pedas' ? 'selected' : '' }}>
                                        Tidak Pedas
                                    </option>   
                                    <option value="pedas" {{ old('kategori') == 'pedas' ? 'selected' : '' }}>Pedas</option>
                                    <option value="sangat pedas" {{ old('kategori') == 'sangat pedas' ? 'selected' : '' }}>
                                        Sangat Pedas
                                    </option>
                                </select>
                                @error("kategori")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <div class="col-md-6">
                                <label class="form-label">Harga</label>

                                <!-- INPUT TAMPILAN (FE) -->
                                <input type="text" id="harga_view" class="form-control" placeholder="Contoh: 15.000"
                                    autocomplete="off" required>

                                <!-- INPUT ASLI (BE) -->
                                <input type="hidden" name="harga" id="harga">

                                @error("harga")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>

                            <!-- STOK -->
                            <div class="col-md-12">
                                <label class="form-label">Jumlah / Stok</label>
                                <input type="number" min="0"
                                    class="form-control @error("jumlah") is-invalid @enderror" name="jumlah"
                                    value="{{ old("jumlah") }}">
                                @error("jumlah")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control @error("deskripsi") is-invalid @enderror" name="deskripsi" rows="3" maxlength="200"
                                    placeholder="Deskripsi singkat produk (maks 200 karakter)">{{ old("deskripsi") }}</textarea>
                                @error("deskripsi")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- GAMBAR -->
                            <div class="col-12">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" class="form-control @error("gambar") is-invalid @enderror"
                                    name="gambar" onchange="previewImage()">
                                @error("gambar")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <img id="img-preview" class="img-fluid mt-3 rounded border"
                                    style="max-width: 200px; display:none;">
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-2">
                            <a href="{{ url("product") }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Batal
                            </a>
                            <button class="btn btn-danger">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('input[name=gambar]');
            const imgPreview = document.getElementById('img-preview');

            imgPreview.style.display = 'block';
            imgPreview.src = URL.createObjectURL(image.files[0]);
        }
    </script>

    <script>
        const hargaView = document.getElementById('harga_view');
        const hargaReal = document.getElementById('harga');

        hargaView.addEventListener('input', function() {
            let angka = this.value.replace(/\D/g, '');

            // set ke input hidden (untuk backend)
            hargaReal.value = angka;

            // tampilkan format rupiah
            this.value = formatRupiah(angka);
        });

        function formatRupiah(angka) {
            if (!angka) return '';
            return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    </script>

@endsection
