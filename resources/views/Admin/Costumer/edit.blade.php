@extends('Admin.Layouts.main')

@section('container')
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Customer</h6>

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('customer/' . $customer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- NAMA --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $customer->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $customer->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NO WA --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No WhatsApp</label>
                            <input type="text" name="no_wa" class="form-control @error('no_wa') is-invalid @enderror"
                                value="{{ old('no_wa', $customer->no_wa) }}">
                            @error('no_wa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PASSWORD (OPSIONAL) --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password (Opsional)</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Kosongkan jika tidak diubah">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ALAMAT --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $customer->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- FOTO --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control" onchange="previewImage()">

                            @if ($customer->foto)
                                <img id="img-preview" src="{{ asset('uploads/customer/' . $customer->foto) }}"
                                    class="mt-3 rounded shadow-sm" style="width:200px;height:200px;object-fit:cover">
                            @else
                                <img id="img-preview" class="mt-3 d-none rounded shadow-sm"
                                    style="width:200px;height:200px;object-fit:cover">
                            @endif
                        </div>

                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ url('customer') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button class="btn btn-danger">
                            <i class="bi bi-save me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT PREVIEW FOTO --}}
    <script>
        function previewImage() {
            const image = document.querySelector('input[name="foto"]');
            const preview = document.getElementById('img-preview');

            preview.src = URL.createObjectURL(image.files[0]);
            preview.classList.remove('d-none');
        }
    </script>
@endsection
