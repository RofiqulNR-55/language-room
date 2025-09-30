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
        $folders = Modul::whereNotNull('folder')->pluck('folder')->unique();
        return view('admin.modul.create', compact('folders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenjang' => 'required|string|in:sd,smp,sma',
            'folder' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:5120',
        ]);

        // Simpan file ke storage/app/public/modul
        $path = $request->file('file')->store('modul', 'public');

        $folder = $request->folder;
        if ($folder === '__new__') {
            $folder = $request->folder_new;
        }
        // Simpan ke database
        Modul::create([
            'judul' => $request->judul,
            'jenjang' => $request->jenjang,
            'folder' => $folder,
            'file' => $path, // path: modul/namafile.pdf
        ]);

        return redirect()->route('admin.modul.index')->with('success', 'Modul berhasil ditambahkan.');
    }

    public function edit(Modul $modul)
    {
        $folders = Modul::whereNotNull('folder')->pluck('folder')->unique();
        return view('admin.modul.edit', compact('modul', 'folders'));
    }

    public function update(Request $request, Modul $modul)
    {
        $request->validate([
            'judul' => 'required',
            'jenjang' => 'required|in:sd,smp,sma',
            'folder' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($modul->file);

            // Upload file baru
            $path = $request->file('file')->store('modul', 'public');
            $modul->file = $path;
        }

        $folder = $request->folder;
        if ($folder === '__new__') {
            $folder = $request->folder_new;
        }
        $modul->judul = $request->judul;
        $modul->jenjang = $request->jenjang;
        $modul->folder = $folder;
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
