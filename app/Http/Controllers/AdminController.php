<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class AdminController extends Controller
{
    public function dashboard()
    {
        $berita = Berita::all();
        return view('admin.dashboard', compact('berita'));
    }
}
    