@extends('layouts.web')
@section('content')
<div class="container mt-10">
    <p class="text-danger mt-10">{{ $berita->kategori ? $berita->kategori->nama : '-' }}</p>
    <h1 class="">{{ $berita->judul }}</h1>
    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="">
    <p>{!! $berita->isi !!}</p>
    <p>Kategori: {{ $berita->kategori ? $berita->kategori->nama : '-' }}</p>
</div>
@endsection