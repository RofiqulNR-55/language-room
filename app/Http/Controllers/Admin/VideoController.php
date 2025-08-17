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
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'jenjang' => 'required|in:sd,smp,sma',
            'url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4|max:102400',
        ]);

        $video = new Video();
        $video->judul = $request->judul;
        $video->deskripsi = $request->deskripsi;
        $video->jenjang = $request->jenjang;

        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('video', 'public');
            $video->url = $path;
        } else {
            $video->url = $request->url;
        }

        $video->save();

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil ditambahkan');
    }

    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'jenjang' => 'required|in:sd,smp,sma',
            'url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4|max:102400',
        ]);

        $video->judul = $request->judul;
        $video->deskripsi = $request->deskripsi;
        $video->jenjang = $request->jenjang;

        if ($request->hasFile('video_file')) {
            if ($video->url && Storage::disk('public')->exists($video->url)) {
                Storage::disk('public')->delete($video->url);
            }

            $path = $request->file('video_file')->store('video', 'public');
            $video->url = $path;
        } else {
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
