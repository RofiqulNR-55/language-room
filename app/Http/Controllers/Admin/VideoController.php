<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        $folders = Video::whereNotNull('folder')->pluck('folder')->unique();
        return view('admin.video.create', compact('folders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'jenjang' => 'required|in:sd,smp,sma',
            'tipe' => 'required|in:link,file',
            'url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4|max:102400',
        ]);

        $video = new Video();
        $video->judul = $request->judul;
        $video->deskripsi = $request->deskripsi;
        $video->jenjang = $request->jenjang;
        $video->tipe = $request->tipe;
        $folder = $request->folder;
        if ($folder === '__new__') {
            $folder = $request->folder_new;
        }
        $video->folder = $folder;

        if ($request->tipe === 'file' && $request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('video', 'public');
            $video->url = $path;
        } elseif ($request->tipe === 'link') {
            $video->url = $request->url;
        } else {
            $video->url = null;
        }

        $video->save();

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil ditambahkan');
    }

    public function edit(Video $video)
    {
        $folders = Video::whereNotNull('folder')->pluck('folder')->unique();
        return view('admin.video.edit', compact('video', 'folders'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'jenjang' => 'required|in:sd,smp,sma',
            'tipe' => 'required|in:link,file',
            'url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4|max:102400',
        ]);

        $video->judul = $request->judul;
        $video->deskripsi = $request->deskripsi;
        $video->jenjang = $request->jenjang;
        $video->tipe = $request->tipe;
        $folder = $request->folder;
        if ($folder === '__new__') {
            $folder = $request->folder_new;
        }
        $video->folder = $folder;

        if ($request->tipe === 'file' && $request->hasFile('video_file')) {
            if ($video->url && Storage::disk('public')->exists($video->url)) {
                Storage::disk('public')->delete($video->url);
            }
            $path = $request->file('video_file')->store('video', 'public');
            $video->url = $path;
        } elseif ($request->tipe === 'link') {
            // Jika sebelumnya file, hapus file lama
            if ($video->tipe === 'file' && $video->url && Storage::disk('public')->exists($video->url)) {
                Storage::disk('public')->delete($video->url);
            }
            $video->url = $request->url;
        }

        $video->save();

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil diperbarui');
    }

    public function destroy(Video $video)
    {
        if ($video->url && Storage::disk('public')->exists($video->url)) {
            Storage::disk('public')->delete($video->url);
        }

        $video->delete();

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil dihapus');
    }
}
