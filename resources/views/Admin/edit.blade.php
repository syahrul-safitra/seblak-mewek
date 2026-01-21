@extends('Admin.Layouts.main')

@section('container')
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Admin</h6>

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <form action="{{ url('set-admin/' . $admin->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ @old('name', $admin->name) }}" autocomplete="off" autofocus>
                        @error('name')
                            <div class="invalid-feedback text-red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" min="1" class="form-control @error('email') is-invalid @enderror"
                            name="email" id="email" value="{{ @old('email', $admin->email) }}" autocomplete="off"
                            readonly>
                        @error('email')
                            <div class="invalid-feedback text-red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" min="0" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password" value="{{ @old('password') }}" autocomplete="off">
                        @error('password')
                            <div class="invalid-feedback text-red">{{ $message }}</div>
                        @enderror
                    </div>

                    <a hre f="{{ url('dashboard') }}" class="btn btn-warning me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
