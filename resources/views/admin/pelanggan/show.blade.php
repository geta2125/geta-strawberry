@extends('layouts.admin.app')

@section('content')
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
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Pelanggan</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Detail Pelanggan</h1>
                <p class="mb-0">Informasi pelanggan dan file pendukung.</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-info">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow mb-4">
                <div class="card-body">

                    {{-- INFORMASI PELANGGAN --}}
                    <h5 class="mb-3">Informasi Umum</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Nama:</strong> {{ $pelanggan->first_name }} {{ $pelanggan->last_name }}</p>
                            <p><strong>Email:</strong> {{ $pelanggan->email }}</p>
                            <p><strong>No HP:</strong> {{ $pelanggan->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tanggal Lahir:</strong> {{ $pelanggan->birthday }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $pelanggan->gender }}</p>
                        </div>
                    </div>

                    <hr>

                    {{-- DAFTAR FILE --}}
                    <h5 class="mb-3">File Pendukung</h5>

                    @if ($files->count())
                        <ul class="list-group mt-3">
                            @foreach ($files as $file)
                                <li class="list-group-item d-flex justify-content-between align-items-center">

                                    {{-- LINK FILE --}}
                                    <a href="{{ asset('uploads/multiple/' . $file->filename) }}" target="_blank"
                                        class="fw-semibold">
                                        {{ $file->filename }}
                                    </a>

                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Belum ada file yang diupload.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
