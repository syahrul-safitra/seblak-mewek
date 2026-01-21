@extends('User.Layouts.main')

@section('container')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Pembayaran</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Pembayaran</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <div class="container-fluid pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pb-5 d-flex align-items-center justify-content-center">
                    {{-- <img style="width: 50%; height: 50%;" src="{{ asset('Costumer/img/menu-2.jpg') }}" frameborder="0"
                        style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></img> --}}
                    <img class="img-fluid" src="{{ asset('file/' . $cart->product->gambar) }}" frameborder="0"
                        style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></img>
                </div>
                <div class="col-md-6 pb-5">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form action="{{ url('store-order') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="costumer_id" value="{{ $costumer->id }}">

                            <input type="hidden" name="product_id" value="{{ $cart->product->id }}">

                            <input type="hidden" name="cart_id" value="{{ $cart->id }}">

                            <input type="hidden" name="jumlah" value="{{ $cart->jumlah }}">

                            <input type="hidden" name="total_keseluruhan"
                                value="{{ $cart->jumlah * $cart->product->harga }}">

                            <div class="control-group mb-3">
                                <input type="text" class="form-control bg-transparent p-4" id="name"
                                    placeholder="Your Name" required="required"
                                    data-validation-required-message="Please enter your name"
                                    value="{{ 'Nama : ' . $costumer->name }}" readonly />
                            </div>
                            <div class="control-group mb-3">
                                <input type="email" class="form-control bg-transparent p-4" id="email"
                                    placeholder="Your Email" required="required"
                                    data-validation-required-message="Please enter your email"
                                    value="{{ 'Email : ' . $costumer->email }}" readonly />
                            </div>


                            <div class="control-group mb-3">
                                <input type="text" class="form-control bg-transparent p-4" id="subject"
                                    placeholder="Subject" required="required" value="{{ 'No WA : ' . $costumer->no_wa }}"
                                    readonly data-validation-required-message="Please enter a subject" />
                            </div>

                            <div class="control-group mb-3">
                                <input type="text" class="form-control bg-transparent p-4" id="subject"
                                    placeholder="Subject" required="required" value="{{ 'Alamat : ' . $costumer->alamat }}"
                                    readonly data-validation-required-message="Please enter a subject" />
                            </div>
                            <div class="control-group mb-3">
                                <input type="text" class="form-control bg-transparent p-4" id="subject"
                                    placeholder="Subject" required="required" value="{{ 'Jumlah : ' . $cart->jumlah }}"
                                    readonly data-validation-required-message="Please enter a subject" />
                            </div>

                            <div class="control-group mb-3">
                                <input type="text" class="form-control bg-transparent p-4" id="subject"
                                    placeholder="Subject" required="required"
                                    value="{{ 'Total : ' . $cart->jumlah * $cart->product->harga }}" readonly
                                    data-validation-required-message="Please enter a subject" />
                            </div>

                            <div class="control-group mb-3">
                                <textarea class="form-control bg-transparent py-3 px-4" rows="5" placeholder="Keterangan" name="keterangan"
                                    maxlength="200"></textarea>
                            </div>

                            <div class="form-group">

                                <label for="">Bukti Resi</label>
                                <input type="file" name="bukti" id="image" onchange="previewImage()"
                                    class="form-control" accept="image/png, image/gif, image/jpeg" required>
                                <div class="form-group mt-3"><img src="" alt="" id="img-preview"
                                        class="w-50 h-50"></div>
                            </div>

                            <div>
                                <button class="btn btn-primary font-weight-bold py-3 px-5" type="submit">Bayar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
