<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\About\Models\AboutUs;
use Modules\About\Models\AboutGallery;

class AboutController extends Controller
{
    /**
     * Show the single edit form for AboutUs + gallery management.
     * This is a singleton page — no index, no create, no show.
     */
    public function edit()
    {
        $about = AboutUs::getContent();
        $galleries = AboutGallery::orderBy('order')->get();

        return view('admin::about.edit', compact('about', 'galleries'));
    }

    /**
     * Update the singleton AboutUs text content.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'story'    => 'nullable|string',
        ]);

        $about = AboutUs::getContent();
        $about->update($validated);

        return redirect()->route('admin.about.edit')
            ->with('success', 'Informasi Tentang Kami berhasil diperbarui.');
    }

    /**
     * Store a new gallery photo.
     */
    public function storeGallery(Request $request)
    {
        $validated = $request->validate([
            'image'    => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|in:interior,proses_masak,suasana,lainnya',
            'caption'  => 'nullable|string|max:255',
            'order'    => 'nullable|integer|min:0',
        ]);

        $path = $request->file('image')->store('about', 'public');
        $validated['image'] = basename($path);
        $validated['category'] = $validated['category'] ?? 'lainnya';
        $validated['order'] = $validated['order'] ?? 0;

        AboutGallery::create($validated);

        return redirect()->route('admin.about.edit')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    /**
     * Delete a gallery photo.
     */
    public function destroyGallery(AboutGallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete('about/' . $gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.about.edit')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}