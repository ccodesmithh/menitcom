@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori</h6>
        </div>
        <div class="card-body">
        <form method="POST" action="{{ route('kategori.store') }}">
            @csrf
            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
            </div>
            <button class="btn btn-primary">Simpan</button>
        </form>
        </div>
    </div>
</div>

@endsection