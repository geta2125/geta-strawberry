@extends('layouts.admin.app')

@section('content')
    <div class="py-4">
        <h1 class="h4">Edit User</h1>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Tampil error validasi kalau ada --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email User</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="Super Admin" {{ $user->role == "Super Admin" ? 'selected' : '' }}>Super Admin</option>
                        <option value="Administrator" {{ $user->role == "Administrator" ? 'selected' : '' }}>Administrator</option>
                        <option value="Pelanggan" {{ $user->role == "Pelanggan" ? 'selected' : '' }}>Pelanggan</option>
                        <option value="Mitra" {{ $user->role == "Mitra" ? 'selected' : '' }}>Mitra</option>
                    </select>

                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password (opsional)</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Isi jika ingin ganti password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Profil</label>
                    <input type="file" name="profile_picture" accept="image/jpeg,image/png,image/jpg,image/gif"
                        class="form-control @error('profile_picture') is-invalid @enderror">
                    @error('profile_picture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($user->profile_picture)
                        <div class="mt-2">
                            <p class="mb-1">Foto profil:</p>
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" width="70" class="rounded">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
@endsection
