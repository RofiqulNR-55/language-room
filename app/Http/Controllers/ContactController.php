<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Menampilkan halaman kontak.
     */
    public function index()
    {
        return view('kontak'); // Nama file view harusnya 'contact.blade.php'
    }
}