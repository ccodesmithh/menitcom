@extends('layouts.admin') 

@section('content') 

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
            <a href="{{ route('berita.create') }}" class="btn btn-sm btn-primary">+ Tambah Berita</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($berita as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->judul }}</td>
                            <td>{{ $b->kategori->nama }}</td>
                            <td>
                                <a href="{{ route('berita.edit', $b->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('berita.destroy', $b->id) }}" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection