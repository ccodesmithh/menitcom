@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Kategori</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label>Password (biarkan kosong jika tidak ingin diubah)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="penulis" {{ $user->role == 'penulis' ? 'selected' : '' }}>Penulis</option>
                </select>
            </div>

            <button class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection