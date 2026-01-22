@extends('User.Layouts.main')

@section('title', 'Profile Saya')

@section('container')
    <div class="container" style="padding-top:120px; padding-bottom:80px">

        <div class="row g-4">

            {{-- ================= PROFILE ================= --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body text-center p-4">

                        @if (session('success'))
                            <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            </div>
                        @endif


                        @if ($errors->any())
                            <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Terdapat Error
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            </div>
                        @endif

                        <div class="position-relative d-inline-block mb-3">
                            <div class="rounded-circle p-1" style="background: linear-gradient(135deg, #ff4d4d, #ff9900);">
                                <img src="{{ $customer->foto ? asset('uploads/customer/' . $customer->foto) : asset('assets/img/user.png') }}"
                                    class="rounded-circle bg-white" width="130" height="130" style="object-fit:cover">
                            </div>
                        </div>

                        <h4 class="fw-bold mb-0">{{ $customer->name }}</h4>
                        <small class="text-muted">{{ $customer->email }}</small>

                        <hr>

                        <div class="text-start small">
                            <div class="d-flex mb-2">
                                <i class="bi bi-whatsapp text-success me-2"></i>
                                <span>{{ $customer->no_wa }}</span>
                            </div>
                            <div class="d-flex">
                                <i class="bi bi-geo-alt text-danger me-2"></i>
                                <span>{{ $customer->alamat }}</span>
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 mt-4 rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#editProfileModal">
                            Edit Profile
                        </button>

                    </div>
                </div>
            </div>

            {{-- ================= RIWAYAT ORDER ================= --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Riwayat Pemesanan</h5>
                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                {{ $orders->count() }} Pesanan
                            </span>
                        </div>

                        @forelse ($orders as $order)
                            <div class="order-item border rounded-4 p-3 mb-3">

                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-semibold mb-1">
                                            {{ $order->product->nama }}
                                        </h6>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar me-1"></i>
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </small>
                                    </div>

                                    <span
                                        class="badge rounded-pill px-3
                                    @if ($order->status == 'pending') bg-warning
                                    @elseif($order->status == 'menunggu_verifikasi') bg-info
                                    @elseif($order->status == 'selesai') bg-success
                                    @else bg-secondary @endif">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </div>

                                <div class="row small mt-3">
                                    <div class="col-6">
                                        <i class="bi bi-box me-1"></i>
                                        Jumlah: <strong>{{ $order->jumlah }}</strong>
                                    </div>
                                    <div class="col-6">
                                        🌶️ Level: <strong>{{ $order->level_pedas }}</strong>
                                    </div>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>Total</strong>
                                    <div class="text-end">
                                        <h6 class="fw-bold text-danger mb-0">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </h6>
                                        <a href="{{ url('/detail-order/' . $order->id) }}"
                                            class="small text-decoration-none">
                                            Lihat Detail →
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-receipt fs-1 mb-3"></i>
                                <p class="mb-0">Belum ada riwayat pemesanan</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- ================= MODAL EDIT PROFILE ================= --}}
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('/profile/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        @if ($errors->any())



                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $customer->name) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $customer->email) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">No WhatsApp</label>
                                <input type="text" name="no_wa" class="form-control"
                                    value="{{ old('no_wa', $customer->no_wa) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control"
                                    value="{{ old('alamat', $customer->alamat) }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Password</label>
                                <input type="text" name="password" class="form-control"
                                    placeholder="Kosongkan jika tidak ingin ganti">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Foto Profile</label>
                                <input type="file" name="foto" class="form-control" accept="image/*"
                                    onchange="previewFoto(event)">
                            </div>

                            <div class="col-md-12 text-center">
                                <img id="previewImg"
                                    src="{{ $customer->foto ? asset('uploads/customer/' . $customer->foto) : asset('assets/img/user.png') }}"
                                    class="img-fluid rounded-circle shadow-sm"
                                    style="width: 120px; height:120px; object-fit:cover;">
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function previewFoto(event) {
            const img = document.getElementById('previewImg');
            img.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

    <style>
        .order-item {
            transition: .3s ease;
            background: #fff;
        }

        .order-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }
    </style>
@endsection
