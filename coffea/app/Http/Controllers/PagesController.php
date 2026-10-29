<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Halaman beranda
    public function home()
    {
        return view('home'); // Mengarah ke resources/views/home.blade.php
    }

    // Halaman about
    public function about()
    {
        return "Ini halaman about";
    }

    // Halaman kontak
    public function contact()
    {
        return "Ini halaman kontak";
    }
}
