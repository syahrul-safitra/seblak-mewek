@extends("Auth.main")

@section("title", "Registrasi Customer")

@section("container")
    <div class="row w-100 justify-content-center">
        <div class="col-lg-9">
            <div class="card auth-card overflow-hidden shadow-lg">
                <div class="row g-0">

                    <!-- LEFT BRAND -->
                    <div class="col-md-5 d-none d-md-flex align-items-center auth-left text-white">
                        <div class="p-4">
                            <h2 class="fw-bold mb-3">Seblak Pedas 🔥</h2>
                            <p class="mb-0">
                                Daftar sekarang dan nikmati seblak pedas favoritmu
                                dengan topping melimpah!
                            </p>
                        </div>
                    </div>

                    <!-- RIGHT FORM -->
                    <div class="col-md-7 bg-white">
                        <div class="p-md-5 p-4">
                            <h4 class="fw-bold mb-4 text-center">Registrasi Customer</h4>

                            <form action="{{ url("/register") }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name"
                                            class="form-control @error("name") is-invalid @enderror"
                                            value="{{ old("name") }}">
                                        @error("name")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error("email") is-invalid @enderror"
                                            value="{{ old("email") }}">
                                        @error("email")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="text" name="password"
                                            class="form-control @error("password") is-invalid @enderror">
                                        @error("password")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No WhatsApp</label>
                                        <input type="text" name="no_wa"
                                            class="form-control @error("no_wa") is-invalid @enderror"
                                            value="{{ old("no_wa") }}">
                                        @error("no_wa")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat" rows="2" class="form-control @error("alamat") is-invalid @enderror">{{ old("alamat") }}</textarea>
                                        @error("alamat")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Foto</label>
                                        <input type="file" name="foto" class="form-control"
                                            onchange="previewImage(event)">
                                        <img id="preview" class="d-none mt-3 rounded"
                                            style="width: 120px; height: 120px; object-fit: cover;">

                                        @error("foto")
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button class="btn btn-primary w-100 mt-3">
                                    Daftar Sekarang
                                </button>

                                <p class="mb-0 mt-3 text-center">
                                    Sudah punya akun?
                                    <a href="{{ url("/login") }}">Login</a>
                                </p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const img = document.getElementById('preview');
            img.src = URL.createObjectURL(event.target.files[0]);
            img.classList.remove('d-none');
        }
    </script>
@endsection
