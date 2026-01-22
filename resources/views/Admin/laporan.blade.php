@extends('Admin.Layouts.main')

@section('container')
    <div class="row">
        <div class="col-12">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-clipboard-data me-2 text-danger"></i>Laporan Penjualan
                </h4>
            </div>

            {{-- FILTER --}}
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <form method="GET" action="{{ url('laporan') }}">
                        <div class="row g-3 align-items-end">

                            <div class="col-md-4">
                                <label class="form-label">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" class="form-control"
                                    value="{{ request('tanggal_awal') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" class="form-control"
                                    value="{{ request('tanggal_akhir') }}">
                            </div>

                            <div class="col-md-4 d-flex gap-2">
                                <button class="btn btn-danger w-100">
                                    <i class="bi bi-search me-1"></i>Filter
                                </button>
                                <a href="{{ url('laporan') }}" class="btn btn-outline-secondary w-100">
                                    Reset
                                </a>

                                <a href="{{ url('laporan/pdf') . '?' . http_build_query(request()->query()) }}"
                                    class="btn btn-danger">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>


                            </div>

                        </div>
                    </form>
                </div>
            </div>

            {{-- RINGKASAN --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <small class="text-muted">Total Order</small>
                            <h4 class="fw-bold mb-0">{{ $totalOrder }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <small class="text-muted">Total Pendapatan</small>
                            <h4 class="fw-bold text-danger mb-0">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="40">No</th>
                                    <th>Nama Pembeli</th>
                                    <th>Produk</th>
                                    <th class="text-center">Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $order->customer->name }}</td>

                                        <td>{{ $order->product->nama }}</td>

                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark">
                                                {{ $order->jumlah }}
                                            </span>
                                        </td>

                                        <td>
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            {{ $order->created_at->format('d-m-Y') }}
                                        </td>

                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($order->status == 'berhasil')
                                                <span class="badge bg-success">Berhasil</span>
                                            @else
                                                <span class="badge bg-danger">Gagal</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                            Data laporan belum tersedia
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
@endsection
