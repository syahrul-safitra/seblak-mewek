@extends('Admin.Layouts.main')

@section('container')
    <div class="col-12">
        <h4 class="mb-2"><i class="bi bi-box-arrow-up me-2"></i>Detail Pemesanan</h4>
        {{-- Session Message --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex gap-2">


                <a href="{{ url('orders') }}" class="btn btn-info mb-3"><i
                        class="bi bi-arrow-left-circle me-2"></i>Kembali</a>

                <div class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="bi bi-clipboard me-2"></i>Status</div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="modal-content" action="{{ url('set-status/' . $order->id) }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <label class="form-label">Change Status</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="pending"
                                        value="pending" required @checked($order->status == 'pending')>
                                    <label class="form-check-label" for="pending">
                                        Pending
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="berhasil"
                                        value="berhasil" @checked($order->status == 'berhasil')>
                                    <label class="form-check-label" for="berhasil">
                                        Berhasil
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="gagal"
                                        value="gagal" @checked($order->status == 'gagal')>
                                    <label class="form-check-label" for="gagal">
                                        Gagal
                                    </label>
                                </div>

                                <div class="form-control">

                                    <label class="form-label">Change Bukti Pembayaran</label>

                                    <input type="file" class="form-control" name="bukti">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <table class="table table-striped table-hover">

                <tbody>
                    <tr>
                        <th scope="row" style="width: 30%">Nama Pembeli</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ $order->costumer->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 30%">Nama Produk</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ $order->product->nama }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 30%">Jumlah</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ $order->jumlah }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 30%">Total Harga</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ 'Rp ' . number_format($order->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 30%">Tanggal</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 30%">Keterangan</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ $order->keterangan }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 30%">Status</th>
                        <td style="width: 5%">:</td>
                        {{-- <td style="width: 65%">{{ $order->status }}</td> --}}

                        @if ($order->status == 'pending')
                            <td style="width: 65%"><span class="badge bg-warning">{{ $order->status }}</span></td>
                        @elseif($order->status == 'berhasil')
                            <td style="width: 65%"><span class="badge bg-success">{{ $order->status }}</span></td>
                        @else
                            <td style="width: 65%"><span class="badge bg-danger">{{ $order->status }}</span></td>
                        @endif

                    </tr>
                    <tr>
                        <th scope="row" style="width: 30%">Bukti Pembayaran</th>
                        <td style="width: 5%">:</td>
                        <td><a href="{{ asset('file/' . $order->bukti) }}" class="btn btn-info"
                                style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px;"><i
                                    class="bi bi-card-image"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 30%">Resi Pembayaran</th>
                        <td style="width: 5%">:</td>
                        <td><a href="{{ url('cetak-struk/' . $order->id) }}" class="btn btn-info"
                                style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px;"><i
                                    class="far fa-file"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
