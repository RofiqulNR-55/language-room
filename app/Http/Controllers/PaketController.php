<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaketController extends Controller
{
    /**
     * Menampilkan halaman daftar paket untuk admin.
     */
    public function index()
    {
        $pakets = Paket::all();
        return view('admin.paket.index', compact('pakets'));
    }

    /**
     * Menampilkan form untuk membuat paket baru.
     */
    public function create()
    {
        return view('admin.paket.create');
    }

    /**
     * Menyimpan paket baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:online,offline',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:255',
        ]);

        Paket::create($request->all());

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit paket.
     */
    public function edit(Paket $paket)
    {
        return view('admin.paket.edit', compact('paket'));
    }

    /**
     * Memperbarui data paket di database.
     */
    public function update(Request $request, Paket $paket)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:online,offline',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:255',
        ]);

        $paket->update($request->all());

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Menghapus paket dari database.
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil dihapus.');
    }

    /**
     * Menampilkan halaman paket online untuk pengguna.
     */
    public function online()
    {
        $pakets = Paket::where('tipe', 'online')->get();
        return view('paket.paket-online', compact('pakets'));
    }

    /**
     * Menampilkan halaman paket offline untuk pengguna.
     */
    public function offline()
    {
        $pakets = Paket::where('tipe', 'offline')->get();
        return view('paket.paket-offline', compact('pakets'));
    }
}