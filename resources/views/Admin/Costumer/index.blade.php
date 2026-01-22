@extends('Admin.Layouts.main')

@section('title', 'Data Customer')

@section('container')
    <div class="row">
        <div class="col-12">

            <!-- MODAL FOTO -->
            <div class="modal fade" id="showImageModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-3">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bi bi-person-circle me-2"></i>Foto Customer
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
                    <i class="bi bi-people-fill me-2 text-danger"></i>Data Customer
                </h4>

                <a href="{{ url('admin/customer/create') }}" class="btn btn-danger">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Customer
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
                                    <th>Email</th>
                                    <th>No WhatsApp</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center" width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="fw-semibold">
                                            {{ $item->name }}
                                        </td>

                                        <td>{{ $item->email }}</td>

                                        <td>{{ $item->no_wa }}</td>

                                        <td style="max-width: 250px">
                                            <span class="text-muted">
                                                {{ Str::limit($item->alamat, 60) }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            @if ($item->foto)
                                                <button type="button"
                                                    class="btn btn-outline-secondary btn-sm btn-showImage"
                                                    data-bs-toggle="modal" data-bs-target="#showImageModal"
                                                    data-image="{{ asset('uploads/customer/' . $item->foto) }}">
                                                    <i class="bi bi-image"></i>
                                                </button>
                                            @else
                                                <span class="badge bg-secondary">Tidak ada</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ url('customer/' . $item->id . '/edit') }}"
                                                    class="btn btn-outline-warning btn-sm" title="Detail">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ url('customer/' . $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Customer akan dihapus?')" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                            Data customer belum tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
