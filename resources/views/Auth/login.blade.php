@extends("Auth.main")

@section("title", "Login Customer")

@section("container")
    <div class="row w-100 justify-content-center">
        <div class="col-lg-8">
            <div class="card auth-card overflow-hidden shadow-lg">
                <div class="row g-0">

                    <!-- LEFT BRAND -->
                    <div class="col-md-5 d-none d-md-flex align-items-center auth-left text-white">
                        <div class="p-4">
                            <h2 class="fw-bold mb-3">Seblak Pedas 🔥</h2>
                            <p class="mb-0">
                                Login untuk memesan seblak favoritmu
                                dengan cepat dan mudah.
                            </p>
                        </div>
                    </div>

                    <!-- RIGHT FORM -->
                    <div class="col-md-7 bg-white">
                        <div class="p-md-5 p-4">
                            <h4 class="fw-bold mb-4 text-center">Login Customer</h4>

                            {{-- Session Message --}}
                            @if (session("success"))
                                <div class="alert alert-success">
                                    {{ session("success") }}
                                </div>
                            @endif

                            @if (session("error"))
                                <div class="alert alert-danger">
                                    {{ session("error") }}
                                </div>
                            @endif

                            <form action="{{ url("login") }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error("email") is-invalid @enderror"
                                        value="{{ old("email") }}">
                                    @error("email")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error("password") is-invalid @enderror">
                                    @error("password")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary w-100 mt-3">
                                    Login
                                </button>

                                <p class="mb-0 mt-3 text-center">
                                    Belum punya akun?
                                    <a href="{{ url("/register") }}">Daftar sekarang</a>
                                </p>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
