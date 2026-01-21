@extends('User.Layouts.main')

@section('container')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Keranjang <svg
                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart-dash"
                    viewBox="0 0 16 16">
                    <path d="M6.5 7a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                </svg></h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Keranjang {{ $costumer->name }}</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container py-5">

        @if (session()->has('success'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            @foreach ($costumer->cart as $item)
                <div class="col-xl-6 col-md-12">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="card-body cleartfix">
                                <div class="media d-flex align-items-center justify-content-between">
                                    <div class="align-self-center" style="margin-right: 30px">
                                        <img class=" rounded-circle" style="width: 60px"
                                            src="{{ asset('file/' . $item->product->gambar) }}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>{{ $item->product->nama }}</h4>
                                        <span>{{ 'Jumlah : ' . $item->jumlah }}</span>
                                        <br>

                                        @php
                                            $total = $item->product->harga * $item->jumlah;
                                        @endphp
                                        <span>Total : Rp. {{ $total }}</span>
                                    </div>

                                    <div class="align-self-center">
                                        <div class="d-flex flex-column gap-3">
                                            <form action="{{ url('cart-destroy/' . $item->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-danger w-100"
                                                    onclick="return confirm('Anda akan menghapus data keranjang ?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <a class="btn btn-success"
                                                href="{{ url('order/' . $item->id . '/' . $costumer->id) }}">
                                                <i class="far fa-money-bill-alt"></i>
                                            </a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
