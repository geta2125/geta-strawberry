@extends('layouts.admin.app')

@section('content')

    {{-- HEADER PAGE --}}
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Pelanggan</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap align-items-center">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4 fw-bold">Edit Pelanggan</h1>
                <p class="mb-0 text-muted">Perbarui data profil dan kelola dokumen pelanggan.</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- PEMBUKA FORM UTAMA (Membungkus Row) --}}
    {{-- Perhatikan penambahan enctype="multipart/form-data" --}}
    <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- KOLOM KIRI: FORM DATA UTAMA --}}
            <div class="col-12 col-xl-8 mb-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold text-primary">Informasi Data Diri</h5>
                    </div>
                    <div class="card-body pt-3">

                        {{-- Group: Nama --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        placeholder="Nama Depan" value="{{ $dataPelanggan->first_name }}" required>
                                    <label for="first_name">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        placeholder="Nama Belakang" value="{{ $dataPelanggan->last_name }}" required>
                                    <label for="last_name">Last Name</label>
                                </div>
                            </div>
                        </div>

                        {{-- Group: Biodata --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="birthday" id="birthday" class="form-control"
                                        placeholder="Tanggal Lahir" value="{{ $dataPelanggan->birthday }}">
                                    <label for="birthday">Birthday</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select id="gender" name="gender" class="form-select">
                                        <option value="" disabled selected>Pilih Gender</option>
                                        <option value="Male" {{ $dataPelanggan->gender == 'Male' ? 'selected' : '' }}>
                                            Male
                                        </option>
                                        <option value="Female" {{ $dataPelanggan->gender == 'Female' ? 'selected' : '' }}>
                                            Female</option>
                                        <option value="Other" {{ $dataPelanggan->gender == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                    <label for="gender">Gender</label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <h5 class="mb-3 fw-bold text-primary">Kontak</h5>

                        {{-- Group: Kontak --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="name@example.com" value="{{ $dataPelanggan->email }}" required>
                                    <label for="email">Email Address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        placeholder="Nomor Telepon" value="{{ $dataPelanggan->phone }}">
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: FILE MANAGER --}}
            <div class="col-12 col-xl-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold text-primary">File Pendukung</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light border-0 small mb-3 p-3 rounded-3" role="alert">
                            <i class="fas fa-info-circle me-1 text-info"></i>
                            Pilih file baru di bawah ini untuk mengupload saat menekan tombol <strong>Simpan
                                Perubahan</strong>.
                        </div>

                        {{-- INPUT FILE (Masuk ke dalam form utama) --}}
                        <div class="mb-4">
                            <label for="files" class="form-label small fw-bold text-muted">Upload File Baru</label>
                            <input type="file" name="files[]" multiple class="form-control" id="inputGroupFile">
                            <div class="form-text text-xs">Gunakan Ctrl/Cmd untuk memilih banyak file.</div>
                        </div>

                        <hr class="my-3 opacity-25">

                        <h6 class="text-uppercase text-muted fw-bold" style="font-size: 12px; letter-spacing: 1px;">
                            Daftar File Saat Ini
                        </h6>

                        @if ($files->count())
                            <div class="list-group list-group-flush">
                                @foreach ($files as $file)
                                    <div
                                        class="list-group-item px-0 d-flex justify-content-between align-items-center border-bottom-0 mb-2 rounded bg-white">
                                        <div class="d-flex align-items-center text-truncate me-2">
                                            <div class="icon icon-shape icon-xs bg-light text-primary rounded-circle me-2">
                                                <i class="fas fa-file"></i>
                                            </div>
                                            <a href="{{ asset('uploads/multiple/' . $file->filename) }}" target="_blank"
                                                class="text-dark fw-bold text-truncate" style="font-size: 14px;"
                                                title="{{ $file->filename }}">
                                                {{ $file->filename }}
                                            </a>
                                        </div>

                                        {{-- Tombol Delete (Menggunakan Javascript agar tidak nested form) --}}
                                        <button type="button" class="btn btn-link text-danger p-0" title="Hapus File"
                                            onclick="event.preventDefault(); if(confirm('Hapus file ini?')) { document.getElementById('delete-form-{{ $file->id }}').submit(); }">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="far fa-folder-open fa-2x mb-2 opacity-50"></i>
                                <p class="small mb-0">Belum ada file.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form> {{-- TUTUP FORM UTAMA --}}


    {{-- FORM DELETE TERSEMBUNYI (Ditaruh di luar form utama agar valid HTML) --}}
    @foreach ($files as $file)
        <form id="delete-form-{{ $file->id }}" action="{{ route('pelanggan.delete-file', $file->id) }}" method="POST"
            class="d-none">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

@endsection
