<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BeritaPenulisController extends Controller
{
    public function index()
    {
        $berita = Berita::where('user_id', Auth::id())->latest()->get();
        return view('penulis.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('penulis.berita.create', compact('kategori'));
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

        return redirect()->route('penulis.berita.index')->with('success', 'Berita ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        if ($berita->user_id !== Auth::id()) abort(403);
        $kategori = Kategori::all();
        return view('penulis.berita.edit', compact('berita', 'kategori'));
    }

    public function update(Request $request, Berita $berita)
    {
        if ($berita->user_id !== Auth::id()) abort(403);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'kategori_id' => 'required',
        ]);

        $berita->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('penulis.berita.index')->with('success', 'Berita diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->user_id !== Auth::id()) abort(403);
        $berita->delete();
        return redirect()->route('penulis.berita.index')->with('success', 'Berita dihapus.');
    }
}