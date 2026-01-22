@extends('Admin.Layouts.main')

@section('container')
    <div class="col-12">

        <h4 class="mb-2"><i class="bi bi-box-arrow-up me-2"></i>Detail Pemesanan</h4>

        {{-- Session Message --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="bg-light rounded h-100 p-4">

            <div class="d-flex gap-2 mb-3">

                <a href="{{ url('orders') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                </a>

                <!-- UBAH btn-primary jadi btn-danger atau btn-warning -->
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#statusModal">
                    <i class="bi bi-clipboard me-2"></i>Status
                </button>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{ url('set-status/' . $order->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Change Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <label class="form-label">Change Status</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status"
                                    id="belum_melakukan_pembayaran" value="belum_melakukan_pembayaran" required
                                    @checked($order->status == 'belum_melakukan_pembayaran')>
                                <label class="form-check-label" for="belum_melakukan_pembayaran">Belum Melakukan
                                    Pembayaran</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="menunggu_verfikasi"
                                    value="menunggu_verfikasi" required @checked($order->status == 'menunggu_verfikasi')>
                                <label class="form-check-label" for="menunggu_verfikasi">Menunggu Verfikasi</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="berhasil"
                                    value="berhasil" @checked($order->status == 'berhasil')>
                                <label class="form-check-label" for="berhasil">Berhasil</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="gagal" value="gagal"
                                    @checked($order->status == 'gagal')>
                                <label class="form-check-label" for="gagal">Gagal</label>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="form-label">Change Bukti Pembayaran</label>
                                <input type="file" class="form-control" name="bukti">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            <!-- UBAH btn-primary jadi btn-danger -->
                            <button type="submit" class="btn btn-danger">Save changes</button>
                        </div>

                    </form>
                </div>
            </div>

            <table class="table table-striped table-hover">

                <tbody>
                    <tr>
                        <th scope="row" style="width: 30%">Nama Pembeli</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ $order->customer->name }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Nama Produk</th>
                        <td>:</td>
                        <td>{{ $order->product->nama }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Level Pedas</th>
                        <td>:</td>
                        <td>{{ $order->level_pedas }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Jumlah</th>
                        <td>:</td>
                        <td>{{ $order->jumlah }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Total Harga</th>
                        <td>:</td>
                        <td>{{ 'Rp ' . number_format($order->total_harga, 0, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Tanggal</th>
                        <td>:</td>
                        <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Keterangan</th>
                        <td>:</td>
                        <td>{{ $order->keterangan }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Status</th>
                        <td>:</td>
                        <td>
                            @if ($order->status == 'pending')
                                <span class="badge bg-warning">{{ $order->status }}</span>
                            @elseif($order->status == 'berhasil')
                                <span class="badge bg-success">{{ $order->status }}</span>
                            @else
                                <span class="badge bg-danger">{{ $order->status }}</span>
                            @endif
                        </td>
                    </tr>

                    {{-- <tr>
                        <th scope="row">Bukti Pembayaran</th>
                        <td>:</td>
                        <td>
                            <a href="{{ asset('file/' . $order->bukti) }}" class="btn btn-info">
                                <i class="bi bi-card-image"></i>
                            </a>
                        </td>
                    </tr> --}}

                    @if ($order->bukti)
                        <tr>
                            <th scope="row">Bukti Pembayaran</th>
                            <td>:</td>
                            <td>
                                <a href="{{ asset('uploads/bukti/' . $order->bukti) }}" class="btn btn-danger">
                                    <i class="far fa-file"></i>
                                </a>
                            </td>
                        </tr>
                    @endif

                </tbody>

            </table>

        </div>
    </div>
@endsection
