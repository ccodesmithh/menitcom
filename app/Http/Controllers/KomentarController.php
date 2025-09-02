<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request, $berita_id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'isi' => 'required|string'
        ]);

        Komentar::create([
            'nama' => $request->nama,
            'isi' => $request->isi,
            'berita_id' => $berita_id,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
