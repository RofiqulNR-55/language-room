<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    public function index()
    {
        $moduls = Modul::all();
        return view('admin.modul.index', compact('moduls'));
    }

    public function create()
    {
        return view('admin.modul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenjang' => 'required|string|in:sd,smp,sma',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // Simpan file ke storage/app/public/modul
        $path = $request->file('file')->store('modul', 'public');

        // Simpan ke database
        Modul::create([
            'judul' => $request->judul,
            'jenjang' => $request->jenjang,
            'file' => $path, // path: modul/namafile.pdf
        ]);

        return redirect()->route('admin.modul.index')->with('success', 'Modul berhasil ditambahkan.');
    }

    public function edit(Modul $modul)
    {
        return view('admin.modul.edit', compact('modul'));
    }

    public function update(Request $request, Modul $modul)
    {
        $request->validate([
            'judul' => 'required',
            'jenjang' => 'required|in:sd,smp,sma',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($modul->file);

            // Upload file baru
            $path = $request->file('file')->store('modul', 'public');
            $modul->file = $path;
        }

        $modul->judul = $request->judul;
        $modul->jenjang = $request->jenjang;
        $modul->save();

        return redirect()->route('admin.modul.index')->with('success', 'Modul berhasil diperbarui');
    }

    public function destroy(Modul $modul)
    {
        // Hapus file dari storage
        Storage::disk('public')->delete($modul->file);

        // Hapus data modul dari DB
        $modul->delete();

        return redirect()->route('admin.modul.index')->with('success', 'Modul berhasil dihapus');
    }
}
