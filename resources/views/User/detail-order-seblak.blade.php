@extends("User.Layouts.main")

@section("title", "Detail Pesanan")

@section("container")
    <div class="container" style="padding-top:120px; padding-bottom:80px">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        <h4 class="fw-bold mb-3">Detail Pesanan</h4>

                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted">Nama Menu</small>
                                <p class="fw-semibold">{{ $order->product->nama }}</p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Status</small><br>
                                <span class="badge {{ $order->status == "pending" ? "bg-warning" : "bg-success" }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted">Jumlah</small>
                                <p>{{ $order->jumlah }}</p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Level Pedas</small>
                                <p>Level {{ $order->level_pedas }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Catatan</small>
                            <p>{{ $order->catatan ?? "-" }}</p>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <h6>Total Bayar</h6>
                            <h5 class="fw-bold text-danger">
                                Rp {{ number_format($order->total_harga, 0, ",", ".") }}
                            </h5>
                        </div>

                        {{-- ================= UPLOAD BUKTI ================= --}}
                        <h5 class="fw-bold mb-3">Upload Bukti Pembayaran</h5>

                        @if ($order->bukti_pembayaran)
                            <div class="mb-3 text-center">
                                <img src="{{ asset("uploads/bukti/" . $order->bukti_pembayaran) }}"
                                    class="img-fluid rounded shadow" style="max-height:300px">
                            </div>
                        @endif

                        <form action="{{ url("upload-pembayaran/" . $order->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="file" name="bukti_pembayaran" id="buktiInput" class="form-control"
                                accept="image/*" required>

                            {{-- PREVIEW --}}
                            <img id="previewBukti" class="img-fluid d-none mt-2 rounded shadow" style="max-height:300px">

                            <button class="btn btn-primary w-100 mt-2">
                                Upload Bukti Pembayaran
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('buktiInput');
            const preview = document.getElementById('previewBukti');

            input.addEventListener('change', function() {
                const file = this.files[0];

                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('d-none');
                }
            });
        });
    </script>

@endsection
