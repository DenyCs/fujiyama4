<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\About\Models\AboutGallery;
use Modules\About\Models\GalleryCategory;

class GalleryController extends Controller
{
    /**
     * Display all gallery photos in a thumbnail grid with category filter.
     */
    public function index(Request $request)
    {
        $categoryId = $request->get('category');

        $galleries = AboutGallery::with('galleryCategory')
            ->when($categoryId, fn ($q) => $q->category($categoryId))
            ->orderBy('order')
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();

        $categories = GalleryCategory::orderBy('name')->get();

        return view('admin::gallery.index', compact('galleries', 'categoryId', 'categories'));
    }

    /**
     * Show form to create a new gallery photo.
     */
    public function create()
    {
        $categories = GalleryCategory::orderBy('name')->get();

        return view('admin::gallery.create', compact('categories'));
    }

    /**
     * Store a new gallery photo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image'                => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_category_id'  => 'nullable|exists:gallery_categories,id',
            'caption'              => 'nullable|string|max:255',
            'order'                => 'nullable|integer|min:0',
        ]);

        $path = $request->file('image')->store('about', 'public');
        $validated['image'] = basename($path);
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
        $categories = GalleryCategory::orderBy('name')->get();

        return view('admin::gallery.edit', compact('gallery', 'categories'));
    }

    /**
     * Update an existing gallery photo.
     */
    public function update(Request $request, AboutGallery $gallery)
    {
        $validated = $request->validate([
            'image'                => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_category_id'  => 'nullable|exists:gallery_categories,id',
            'caption'              => 'nullable|string|max:255',
            'order'                => 'nullable|integer|min:0',
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
