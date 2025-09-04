@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
<div class="container mt-4">
    <h2>Profil Admin</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Update Profile --}}
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="card shadow-lg border-0 rounded-3 mb-4">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <img src="{{ $user->avatar ? asset('uploads/avatar/'.$user->avatar) : asset('default-avatar.png') }}"
                    alt="Avatar" class="rounded-circle me-3" width="50" height="50">
                <h5 class="mb-0">Profil Admin</h5>
            </div>
            <div class="card-body">
                {{-- Avatar --}}
                <div class="mb-3">
                    <label for="avatar" class="form-label">Foto Profil</label>
                    <input type="file" name="avatar" id="avatar"
                        class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <img id="avatarPreview"
                             src="{{ $user->avatar ? asset('uploads/avatar/'.$user->avatar) : asset('default-avatar.png') }}"
                             alt="Preview" class="rounded-circle border" width="100" height="100">
                    </div>
                </div>

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ old('name', $user->name) }}" required>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email', $user->email) }}" required>
                </div>

                <hr>
                <h6 class="text-muted">Ubah Password</h6>

                {{-- Current password --}}
                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Lama</label>
                    <input type="password" name="current_password" id="current_password"
                        class="form-control @error('current_password') is-invalid @enderror">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- New password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm password --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control">
                </div>

                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            </div>
        </div>
    </form>

    {{-- Delete Account --}}
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Hapus Akun</h5>
        </div>
        <div class="card-body">
            <p class="text-muted">Akun Anda akan dihapus secara permanen. Tindakan ini tidak bisa dibatalkan.</p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <label for="delete_password" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password" id="delete_password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">Hapus Akun</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('avatar').addEventListener('change', function(event) {
    let reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('avatarPreview').setAttribute('src', e.target.result);
    };
    reader.readAsDataURL(event.target.files[0]);
});
</script>
@endpush
@endsection
