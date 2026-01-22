@extends('Admin.Layouts.main')

@section('container')
    <div class="row">
        <div class="col-12">


            {{-- Session Message --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-cup-hot-fill me-2 text-danger"></i>Order
                </h4>
            </div>


            <div class="card border-0 shadow-sm">
                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table table-hover" id="order_table" style="color:black">

                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pembeli</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->product->nama }}</td>
                                        <td>{{ $order->level_pedas }}</td>
                                        <td>{{ $order->jumlah }}</td>
                                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td>
                                            <span
                                                class="badge
                                    @if ($order->status == 'pending') bg-warning
                                    @elseif($order->status == 'menunggu_verifikasi') bg-info
                                    @elseif($order->status == 'selesai') bg-success
                                    @else bg-secondary @endif">
                                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-4">

                                                <a href="{{ url('detail-order-admin/' . $order->id) }}"
                                                    class="btn btn-outline-warning btn-sm" style="padding: 2px 6px;">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ url('order/' . $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm" style="padding: 2px 6px;"
                                                        onclick="return confirm('Yakin ingin menghapus order ini?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($orders->count() == 0)
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            Tidak ada data order
                                        </td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
