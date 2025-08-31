<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Berita;

class WebController extends Controller
{
    public function index()
    {
        $headline = Berita::latest()->first();
        $trending = Berita::orderBy('views', 'desc')->take(1)->first();
        // dd($trending);
        $berita = Berita::all();
        return view('web.home', compact('berita', 'headline', 'trending'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        return view('web.show', compact('berita'));
    }

    public function kategori($id)
    {
        $berita = Berita::where('kategori_id', $id)->paginate(3);
        return view('web.kategori', compact('berita'));
    }
}
