<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{

    public function dashboard()
    {
        $berita = Berita::all();
        return view('admin.dashboard', compact('berita'));
    }
}
