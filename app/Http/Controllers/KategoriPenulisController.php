<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;


class KategoriPenulisController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all();
        return view('penulis.kategori.index', compact('kategori'));
    }

}
