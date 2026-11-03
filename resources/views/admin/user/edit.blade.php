@extends('layouts.admin.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Edit User</h2>
            <p class="mb-0">Form untuk memperbarui data user.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('user.index') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                Kembali
            </a>
        </div>
    </div>

    {{-- Flash Message Error --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan!</strong> Mohon periksa kembali inputan Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <form action="{{ route('user.update', $dataUser->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri: Name & Email -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $dataUser->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $dataUser->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan: Password & Confirm Password -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-3">
                            <label for="password">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-gray-800 text-white me-2">Simpan</button>
                    <a href="{{ route('user.index') }}" class="btn btn-outline-gray-500">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
