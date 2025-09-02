<title>{{ $berita->judul }} | MENIT.COM</title>
@extends('layouts.web')
@section('content')
<div class="container mt-10">
    <p class="text-danger mt-10">{{ $berita->kategori ? $berita->kategori->nama : '-' }}</p>
    <h1 class="">{{ $berita->judul }}</h1>
    <p>{{ $berita->views }} x dibaca</p>
    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="" loading="lazy">
    <p>{!! $berita->isi !!}</p>
    <p>Kategori: {{ $berita->kategori ? $berita->kategori->nama : '-' }}</p>
    
    <h3>Komentar</h3>
    <form action="{{ route('komentar.store', $berita->id) }}" method="POST">
        @csrf
        <input type="text" name="nama" class="form-control mb-2" placeholder="Tulis Nama Lu" required>
        <textarea name="isi" class="form-control mb-2" rows="3" placeholder="Tulis komentar ente..." required></textarea>
        <button class="btn btn-primary">Kirim</button>
    </form>
    <hr>

    @if($berita->komentars->isEmpty())
        <p>Belum ada komentar.</p>
    @else
        @foreach($berita->komentars as $komentar)
            <div class="mb-3 p-2 border rounded">
                <strong>{{ $komentar->nama }}</strong> <br>
                <small>{{ $komentar->created_at->format('d M Y H:i') }}</small>
                <p>{{ $komentar->isi }}</p>
            </div>
        @endforeach
    @endif

</div>
@endsection