<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\About\Models\AboutGallery;

class GalleryController extends Controller
{
    /**
     * Display all gallery photos in a thumbnail grid with category filter.
     */
    public function index(Request $request)
    {
        $category = $request->get('category');

        $galleries = AboutGallery::query()
            ->when($category, fn ($q) => $q->where('category', $category))
            ->orderBy('order')
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();

        return view('admin::gallery.index', compact('galleries', 'category'));
    }

    /**
     * Show form to create a new gallery photo.
     */
    public function create()
    {
        return view('admin::gallery.create');
    }

    /**
     * Store a new gallery photo.
     */
    public function store(Request $request)
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

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    /**
     * Show form to edit an existing gallery photo.
     */
    public function edit(AboutGallery $gallery)
    {
        return view('admin::gallery.edit', compact('gallery'));
    }

    /**
     * Update an existing gallery photo.
     */
    public function update(Request $request, AboutGallery $gallery)
    {
        $validated = $request->validate([
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|in:interior,proses_masak,suasana,lainnya',
            'caption'  => 'nullable|string|max:255',
            'order'    => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image) {
                Storage::disk('public')->delete('about/' . $gallery->image);
            }
            $path = $request->file('image')->store('about', 'public');
            $validated['image'] = basename($path);
        } else {
            unset($validated['image']);
        }

        $validated['category'] = $validated['category'] ?? 'lainnya';
        $validated['order'] = $validated['order'] ?? 0;

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    /**
     * Delete a gallery photo — also removes file from storage.
     */
    public function destroy(AboutGallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete('about/' . $gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}