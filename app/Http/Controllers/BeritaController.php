<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Auth::user()->role === 'admin'
            ? Berita::latest()->get()
            : Berita::where('user_id', Auth::id())->latest()->get();

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $path = $request->file('gambar') ? $request->file('gambar')->store('berita', 'public') : null;

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'kategori_id' => $request->kategori_id,
            'user_id' => Auth::id(),
            'gambar' => $path,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        $kategori = Kategori::all();
        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([ 
            'judul' => 'required',
            'isi' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->file('gambar')) {
            $path = $request->file('gambar')->store('berita', 'public');
            $berita->gambar = $path;
        }

        $berita->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diupdate.');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita dihapus.');
    }
}
