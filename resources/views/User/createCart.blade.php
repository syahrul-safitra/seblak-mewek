@extends('User.Layouts.main')

<style>
    .comment-card {
        border-left: 4px solid #007bff;
        /* Garis biru di samping kiri */
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        /* Sedikit bayangan */
    }

    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e9ecef;
        /* Border tipis di avatar */
    }

    .comment-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .comment-author {
        font-weight: bold;
        margin-right: 8px;
        color: #212529;
    }

    .comment-date {
        font-size: 0.85em;
        color: #6c757d;
    }

    .comment-body {
        line-height: 1.6;
        color: #343a40;
    }

    /* Gaya khusus untuk form komentar */
    .comment-form-card {
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
        /* Bayangan lebih halus */
    }
</style>

@section('container')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">+ Keranjang <svg
                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart-dash"
                    viewBox="0 0 16 16">
                    <path d="M6.5 7a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                </svg></h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Keranjang</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Reservation Start -->
    <div class="container-fluid py-5">
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

            <div class="reservation position-relative overlay-top overlay-bottom">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-5 my-lg-0">
                        <div class="p-5">
                            <div class="mb-4 d-flex justify-content-center">
                                <h1 class="display-3 text-primary">{{ $product->nama }}</h1>
                            </div>
                            <p class="text-white d-flex justify-content-center">{{ $product->deskripsi }}</p>
                            <ul class="list-inline text-white m-0 d-flex justify-content-center">
                                <img class="w-50 rounded-circle mb-3 mb-sm-0 " src="{{ asset('file/' . $product->gambar) }}"
                                    {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('file/' . $item->gambar) }}" --}} alt="">
                                {{-- </a> --}}
                                {{-- <h5 class="menu-price">{{ substr($product->harga, 0, strlen($product->harga) - 3) . 'k' }}
                                </h5> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center p-5" style="background: rgba(51, 33, 29, .8);">
                            <h1 class="text-white mb-4 mt-5">Data</h1>
                            <form class="mb-5" action="{{ url('storeCart') }}" method="POST">
                                @csrf
                                <div class="form-group">

                                    <input type="hidden" name="harga" value="{{ $product->harga }}">
                                    <input type="hidden" name="costumer_id" value="{{ $user->id }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <input type="text" class="form-control bg-transparent border-primary p-4 text-white"
                                        placeholder="Name" value="{{ $user->name }}" readonly />
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input type="text"
                                            class="form-control bg-transparent border-primary p-4 text-white"
                                            placeholder="Name" value="{{ 'stok : ' . $product->jumlah }}" readonly />

                                        <input type="text"
                                            class="form-control bg-transparent border-primary p-4 text-white"
                                            placeholder="Name" value="{{ 'harga : ' . $product->harga }}" readonly />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="text-white">Jumlah</label>
                                    <input type="number" min="1" value="1" max="{{ $product->jumlah }}"
                                        class="form-control bg-transparent border-primary p-4 text-white" name="jumlah" />
                                </div>

                                <div class="form-group">
                                    <label for="" class="text-white">Total Harga</label>
                                    <input type="text" class="form-control bg-transparent border-primary p-4 text-white"
                                        placeholder="Name" name="total_harga" readonly />
                                </div>

                                <div>
                                    <button class="btn btn-primary btn-block font-weight-bold py-3" type="submit">+
                                        Keranjang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reservation End -->

    {{-- Komentar --}}

    <div class="container mt-5">
        <h2 class="mb-4">Tulis Review Anda</h2>

        <div class="card comment-form-card p-4 mb-5">
            <form action="{{ url('add-reivew/') }}" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="costumer_id" value="{{ $user->id }}">

                <div class="form-group">
                    <label for="commentText">Reivew Anda</label>
                    <textarea class="form-control" name="ulasan" id="commentText" rows="4" placeholder="Tulis Review Anda di sini..."
                        required maxlength="240"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
            </form>
        </div>

        <h2 class="mb-4">Daftar Review</h2>

        @foreach ($product->review as $item)
            <div class="card comment-card p-3 mb-3">
                <div class="comment-header">
                    <img src="{{ asset('file/' . $item->costumer->gambar) }}" alt="Avatar Pengguna 1"
                        class="avatar mr-3">
                    <div>
                        <span class="comment-author">{{ $item->costumer->name }}</span>
                        <span class="comment-date">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="comment-body">
                    <p>{{ $item->ulasan }}</p>
                </div>

                @if ($item->costumer_id == $user->id)
                    <div class="d-flex justify-content-end mt-2">
                        <form action="{{ url('delete-review/' . $item->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-decoration-none text-black btn btn-danger"><small>Hapus</small></button>
                        </form>

                    </div>
                @endif

            </div>
        @endforeach

    </div>
@endsection
