@extends('User.Layouts.main')

@section('container')
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-3 text-white text-uppercase">Profile & History </h1>
            {{-- <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Keranjang</p>
            </div> --}}
        </div>
    </div>

    <div class="container">

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
            {{-- <div class="col-lg-4 bg-primary"> --}}
            <div class="card mb-4" style="margin:auto">
                <div class="card-body text-center">
                    <img src="{{ asset('file/' . $costumer->gambar) }}" alt="avatar" class="rounded-circle img-fluid"
                        style="width: 150px;">
                    <h5 class="my-3">{{ $costumer->name }}</h5>
                    <p class="text-muted mb-1">{{ $costumer->email }}</p>
                    <p class="text-muted mb-1">{{ $costumer->no_wa }}</p>
                    <p class="text-muted mb-4">{{ $costumer->alamat }}</p>
                    {{-- <div class="d-flex justify-content-center mb-2">
                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-primary">Follow</button>
                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-outline-primary ms-1">Message</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($costumer->order as $item)
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
                                        <span>Total : Rp. {{ $item->total_harga }}</span>
                                    </div>

                                    <div class="align-self-center">
                                        <div class="d-flex flex-column gap-3">
                                            <a class="btn btn-info" href="{{ url('detail-order/' . $item->id) }}">
                                                <i class="far fa-window-maximize"></i>
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
