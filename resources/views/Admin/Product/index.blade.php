@extends('Admin.Layouts.main')

@section('title', 'Produk Seblak')

@section('container')
    <div class="row">
        <div class="col-12">

            <!-- MODAL IMAGE -->
            <div class="modal fade" id="showImageModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-3">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bi bi-image me-2"></i>Gambar Produk
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img id="modalImage" class="img-fluid rounded" style="max-height: 350px">
                        </div>
                    </div>
                </div>
            </div>

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-cup-hot-fill me-2 text-danger"></i>Produk Seblak
                </h4>

                <a href="{{ url('product/create') }}" class="btn btn-danger">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Produk
                </a>
            </div>

            <!-- ALERT -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- TABLE CARD -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="40">No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th class="text-center">Gambar</th>
                                    {{-- <th>Kategori</th> --}}
                                    <th>Deskripsi</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center" width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="fw-semibold">
                                            {{ $item->nama }}
                                        </td>

                                        <td>
                                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                                        </td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-secondary btn-sm btn-showImage"
                                                data-bs-toggle="modal" data-bs-target="#showImageModal"
                                                data-image="{{ asset('uploads/produk/' . $item->gambar) }}"
                                                title="Lihat Gambar">
                                                <i class="bi bi-image"></i>
                                            </button>
                                        </td>


                                        {{-- <td>
                                            <span class="badge bg-danger">
                                                {{ $item->kategori }}
                                            </span>
                                        </td> --}}

                                        <td style="max-width: 250px">
                                            <span class="text-muted">
                                                {{ Str::limit($item->deskripsi, 60) }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark">
                                                {{ $item->jumlah }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ url('product/' . $item->id . '/edit') }}"
                                                    class="btn btn-outline-warning btn-sm" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ url('product/' . $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Produk akan dihapus?')" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                            Data produk belum tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="modal fade" id="showImageModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Preview Gambar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img id="modalImage" class="img-fluid rounded" alt="Preview">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-showImage').forEach(button => {
                button.addEventListener('click', function() {
                    const imageUrl = this.getAttribute('data-image');
                    document.getElementById('modalImage').src = imageUrl;
                });
            });
        });
    </script>

@endsection
