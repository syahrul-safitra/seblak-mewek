@extends('Admin.Layouts.main')

@section('container')
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Produk</h6>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('product/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- NAMA --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $product->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- KATEGORI -->
                        {{-- <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="tidak pedas"
                                    {{ old('kategori', $product->kategori) == 'tidak pedas' ? 'selected' : '' }}>
                                    Tidak Pedas
                                </option>
                                <option value="pedas"
                                    {{ old('kategori', $product->kategori) == 'pedas' ? 'selected' : '' }}>Pedas</option>
                                <option value="sangat pedas"
                                    {{ old('kategori', $product->kategori) == 'sangat pedas' ? 'selected' : '' }}>
                                    Sangat Pedas
                                </option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        {{-- HARGA --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" id="harga_display" class="form-control"
                                value="{{ number_format($product->harga, 0, ',', '.') }}">
                            <input type="hidden" name="harga" id="harga" required>
                        </div>

                        {{-- JUMLAH --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                                value="{{ old('jumlah', $product->jumlah) }}">
                            @error('jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" maxlength="200" rows="3">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- GAMBAR --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="gambar" class="form-control" onchange="previewImage()">

                            <img id="img-preview" src="{{ asset('uploads/produk/' . $product->gambar) }}"
                                class="mt-3 rounded" style="width:200px;height:200px;object-fit:cover">
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ url('product') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button class="btn btn-danger">
                            <i class="bi bi-save me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT (SAMA DENGAN CREATE) --}}
    <script>
        const hargaDisplay = document.getElementById('harga_display');
        const hargaHidden = document.getElementById('harga');

        function formatRupiah(angka) {
            return angka.replace(/\D/g, '')
                .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        hargaHidden.value = hargaDisplay.value.replace(/\./g, '');

        hargaDisplay.addEventListener('input', function() {
            this.value = formatRupiah(this.value);
            hargaHidden.value = this.value.replace(/\./g, '');
        });

        function previewImage() {
            const image = document.querySelector('input[name="gambar"]');
            const preview = document.getElementById('img-preview');
            preview.src = URL.createObjectURL(image.files[0]);
        }
    </script>
@endsection
