@extends('Admin.Layouts.main')

@section('title', 'Edit Admin')

@section('container')
    <div class="row g-4">
        <div class="col-md-12 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-person-gear me-2 text-danger"></i>Edit Admin
                    </h5>

                    {{-- ALERT ERROR --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @session('success')
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endsession

                    {{-- FORM --}}
                    <form action="{{ url('set-admin/' . $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $admin->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $admin->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NO WA --}}
                        <div class="mb-3">
                            <label class="form-label">No WhatsApp</label>
                            <input type="text" name="no_wa" class="form-control @error('no_wa') is-invalid @enderror"
                                value="{{ old('no_wa', $admin->no_wa) }}" placeholder="08xxxxxxxxxx">
                            @error('no_wa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="text" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti password
                            </small>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-danger">
                                <i class="bi bi-save me-1"></i> Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
