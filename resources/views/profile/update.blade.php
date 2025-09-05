@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.penulis')

@section('title', 'Profil Anda')

@section('content')
<div class="container mt-4">

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
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <!-- <img src="{{ $user->avatar ? asset('uploads/avatar/'.$user->avatar) : asset('default-avatar.png') }}" -->
                             <!-- alt="Avatar" class="rounded-circle me-3 border avatar-lg"> -->
                        <div>
                            <h5 class="mb-0">Ubah Profil Anda</h5>
                            <small class="text-white-50">Perbarui informasi akun Anda</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-light btn-sm me-2">Batal</a>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </div>

                <div class="card-body">
                    {{-- Avatar --}}
                    <div class="text-center mb-4">
                        <img id="avatarPreview" src="{{ $user->avatar ? asset('uploads/avatar/'.$user->avatar) : asset('default-avatar.png') }}"
                             alt="Preview" class="rounded-circle border mb-3 avatar-xl">
                        <div>
                            <label for="avatar" class="btn btn-secondary btn-sm mb-0">
                                Pilih Foto
                                <input type="file" name="avatar" id="avatar"
                                        @error('avatar') is-invalid @enderror" accept="image/*">
                            </label>
                            @error('avatar') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                            <div class="form-text mt-1">Maks 2MB. Format: jpg, png, gif.</div>
                        </div>
                    </div>

                    <div class="row g-3">
                        {{-- Name --}}
                        <div class="col-12 col-md-6">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="text-muted">Ubah Password <small class="text-muted fw-normal"> (kosongkan jika tidak ingin mengganti)</small></h6>

                    <div class="row g-3">
                        {{-- Current password --}}
                        <div class="col-12">
                            <label for="current_password" class="form-label">Password Lama</label>
                            <input type="password" name="current_password" id="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- New password --}}
                        <div class="col-12 col-md-6">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror">
                            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- Confirm password --}}
                        <div class="col-12 col-md-6">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <!-- optional: additional buttons below for mobile. -->
                    <div class="d-md-none mt-3 text-end">
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </form>
</div>


@endsection