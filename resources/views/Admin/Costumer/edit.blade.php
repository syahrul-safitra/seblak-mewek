@extends('Admin.Layouts.main')

@section('container')
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Costumer</h6>
                <form action="{{ url('costumer/' . $costumer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ @old('name', $costumer->name) }}" autocomplete="off" autofocus>
                        @error('name')
                            <div class="invalid-feedback text-red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" min="1" class="form-control @error('email') is-invalid @enderror"
                            name="email" id="email" value="{{ @old('email', $costumer->email) }}" autocomplete="off">
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

                    <div class="mb-3">
                        <label for="no_wa" class="form-label">No WA</label>
                        <input type="text" min="0" class="form-control @error('no_wa') is-invalid @enderror"
                            name="no_wa" id="no_wa" value="{{ @old('no_wa', $costumer->no_wa) }}" autocomplete="off">
                        @error('no_wa')
                            <div class="invalid-feedback text-red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            id="alamat" value="{{ @old('alamat', $costumer->alamat) }}" autocomplete="off">
                        @error('alamat')
                            <div class="invalid-feedback text-red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="image" onchange="previewImage()" name="gambar">
                        <img class="mt-4" id="img-preview" style="width: 200px; height: 200px"
                            src="{{ asset('file/' . $costumer->gambar) }}">
                        @error('gambar')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <a href="{{ url('dashboard/informasi') }}" class="btn btn-warning me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
