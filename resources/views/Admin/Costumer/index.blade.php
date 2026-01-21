@extends('Admin.Layouts.main')

@section('container')
    <div class="col-12">
        <!-- Modal -->
        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cetak Laporan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('dashboard/suratmasuks/cetak') }}" method="POST">
                        <div class="modal-body">

                            @csrf
                            <div class="d-flex justify-content-around">
                                <input type="date" name="tanggal_awal" required>
                                <input type="date" name="tanggal_akhir" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        {{-- Modal showImage --}}
        <!-- Modal -->
        <div class="modal fade" id="showImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Gambar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <img id="modalImage" alt="Ini gambar" style="height: 400px; width: 400px;" class="bg-primary">
                    </div>
                </div>
            </div>
        </div>


        <h4 class="mb-2"><i class="bi bi-people-fill"></i> Costumer</h4>
        {{-- Session Message --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="bg-light rounded h-100 p-4">
            <div class="table-responsive">
                {{-- <table class="table table-hover" style="color:black" id="surat_masuk"> --}}
                <table class="table table-hover" id="surat_masuk" style="color:black">

                    {{-- <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <a href="{{ url('product/create') }} " class="btn btn-primary mb-3"><i
                                class="bi bi-plus-circle me-2"></i></i>Tambah</a>

                        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                class="bi bi-printer me-2"></i>Cetak</button>
                    </div>

                </div> --}}

                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No WA</th>
                            <th scope="col">Gambar</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($costumers as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->no_wa }}</td>
                                <td>
                                    <div class="d-flex gap-4">

                                        <button class="btn btn-info btn-showImage"
                                            style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px;"
                                            data-image="{{ $item->gambar }}"><i class="bi bi-card-image"></i></button>

                                        <a href="{{ url('costumer/' . $item->id . '/edit') }}" class="btn btn-warning"
                                            style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px"><i
                                                class="bi bi-pencil-square"></i></a>

                                        <form action="{{ url('costumer/' . $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn btn-danger btn-delete-suratmasuk"
                                                onclick="return confirm('Data user akan dihapus.')"
                                                style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
