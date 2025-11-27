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
                <li class="breadcrumb-item active" aria-current="page">Tambah Pelanggan</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap align-items-center">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4 fw-bold">Tambah Pelanggan</h1>
                <p class="mb-0 text-muted">Tambahkan data pelanggan baru dan upload dokumen pendukung.</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- FORM UTAMA (Create) --}}
    {{-- Arahkan ke route store, method POST --}}
    <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                                    <input type="text" name="first_name" id="first_name"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        placeholder="Nama Depan" value="{{ old('first_name') }}" required>
                                    <label for="first_name">First Name</label>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="last_name" id="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        placeholder="Nama Belakang" value="{{ old('last_name') }}" required>
                                    <label for="last_name">Last Name</label>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Group: Biodata --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="birthday" id="birthday"
                                        class="form-control @error('birthday') is-invalid @enderror"
                                        placeholder="Tanggal Lahir" value="{{ old('birthday') }}">
                                    <label for="birthday">Birthday</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select id="gender" name="gender"
                                        class="form-select @error('gender') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other
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
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="name@example.com" value="{{ old('email') }}" required>
                                    <label for="email">Email Address</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="phone" id="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Nomor Telepon" value="{{ old('phone') }}">
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                                <i class="fas fa-save me-1"></i> Simpan Data Baru
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: FILE UPLOAD --}}
            <div class="col-12 col-xl-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold text-primary">File Pendukung</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light border-0 small mb-3 p-3 rounded-3" role="alert">
                            <i class="fas fa-info-circle me-1 text-info"></i>
                            Anda dapat langsung mengupload dokumen pendukung saat membuat data pelanggan ini.
                        </div>

                        <div class="mb-3">
                            <label for="files" class="form-label small fw-bold text-muted">Pilih File</label>
                            <input type="file" name="files[]" multiple class="form-control" id="inputGroupFile">
                            <div class="form-text text-xs">Gunakan Ctrl/Cmd untuk memilih banyak file.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
