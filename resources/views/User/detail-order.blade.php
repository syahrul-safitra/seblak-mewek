@extends('User.Layouts.main')

@section('container')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Detail Pemesanan <svg
                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart-dash"
                    viewBox="0 0 16 16">
                    <path d="M6.5 7a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                </svg></h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Detail Pemesanan</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Reservation Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="reservation position-relative overlay-top overlay-bottom">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-5 my-lg-0">
                        <div class="p-5">
                            <div class="mb-4 d-flex justify-content-center">
                                <h1 class="display-3 text-primary">{{ $order->product->nama }}</h1>
                            </div>
                            <p class="text-white d-flex justify-content-center">{{ $order->product->deskripsi }}</p>
                            <ul class="list-inline text-white m-0 d-flex justify-content-center">
                                <img class="w-50 rounded-circle mb-3 mb-sm-0 "
                                    src="{{ asset('file/' . $order->product->gambar) }}" {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('file/' . $item->gambar) }}" --}}
                                    alt="">
                                {{-- </a> --}}
                                {{-- <h5 class="menu-price">{{ substr($product->harga, 0, strlen($product->harga) - 3) . 'k' }}
                                </h5> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center p-5" style="background: rgba(51, 33, 29, .8);">
                            {{-- <h1 class="text-white mb-4 mt-5">Data</h1> --}}
                            <form class="mb-5">
                                {{-- @csrf --}}
                                <div class="form-group">

                                    <label for="" class="text-white">Nama</label>
                                    <input type="text" class="form-control bg-transparent border-primary p-4 text-white"
                                        placeholder="Name" value="{{ $order->costumer->name }}" readonly />
                                </div>
                                {{-- <div class="form-group">
                                    <div class="d-flex">
                                        <input type="text"
                                            class="form-control bg-transparent border-primary p-4 text-white"
                                            placeholder="Name" value="{{ 'stok : ' . $product->jumlah }}" readonly />

                                        <input type="text"
                                            class="form-control bg-transparent border-primary p-4 text-white"
                                            placeholder="Name" value="{{ 'harga : ' . $product->harga }}" readonly />
                                    </div>
                                </div> --}}

                                <div class="form-group">
                                    <label for="" class="text-white">Jumlah Pemesanan</label>
                                    <input type="text" min="1" value="1" max="{{ $order->jumlah }}"
                                        class="form-control bg-transparent border-primary p-4 text-white" readonly />
                                </div>

                                <div class="form-group">
                                    <label for="" class="text-white">Total Harga</label>
                                    <input type="text" class="form-control bg-transparent border-primary p-4 text-white"
                                        placeholder="Name" value="{{ $order->total_harga }}" readonly />
                                </div>

                                <div class="form-group">
                                    <label for="" class="text-white">Status</label>
                                    <input type="text" class="form-control bg-transparent border-primary p-4 text-white"
                                        placeholder="Name" value="{{ $order->status }}" readonly />
                                </div>

                                <div class="control-group mb-3">
                                    <label for="" class="text-white">Keterangan</label>
                                    <textarea class="form-control bg-transparent py-3 px-4 text-white" rows="5" placeholder="Keterangan"
                                        name="keterangan" maxlength="200" readonly>{{ $order->keterangan }}</textarea>
                                </div>


                                <div>
                                    <a class="btn btn-primary btn-block font-weight-bold py-3"
                                        href="{{ asset('file/' . $order->bukti) }}">
                                        Bukti Pembayaran</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reservation End -->
@endsection
