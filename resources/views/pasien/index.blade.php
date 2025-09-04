@extends('layouts.auth')
@section('title', 'Pasien')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Daftar Pasien</h1>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Pasien
            </button>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <select id="filterRumahSakit" class="form-control">
                    <option value="">Semua Rumah Sakit</option>
                    @foreach($rumahSakits as $rs)
                        <option value="{{ $rs->id }}">
                            {{ $rs->nama_rumah_sakit }} ({{ $rs->pasiens_count }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telpon</th>
                <th>Rumah Sakit</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody id="pasienTableBody">
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="createPasienForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama_pasien" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Telpon</label>
                            <input type="number" class="form-control" name="no_telpon" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rumah Sakit</label>
                            <select class="form-control" name="rumah_sakit_id" required>
                                <option value="">Pilih Rumah Sakit</option>
                                @foreach($rumahSakits as $rs)
                                    <option value="{{ $rs->id }}">{{ $rs->nama_rumah_sakit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editPasienForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="editPasienId" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit_nama_pasien" name="nama_pasien" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="edit_alamat" name="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Telpon</label>
                            <input type="number" class="form-control" id="edit_no_telpon" name="no_telpon" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rumah Sakit</label>
                            <select class="form-control" id="edit_rumah_sakit_id" name="rumah_sakit_id" required>
                                <option value="">Pilih Rumah Sakit</option>
                                @foreach($rumahSakits as $rs)
                                    <option value="{{ $rs->id }}">{{ $rs->nama_rumah_sakit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@push('scripts')
    @vite('resources/js/action/pasien.js')
@endpush
