<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\About\Models\GalleryCategory;

class GalleryCategoryController extends Controller
{
    public function index()
    {
        $categories = GalleryCategory::orderBy('name')->paginate(20);

        return view('admin::gallery-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin::gallery-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:gallery_categories,name',
        ]);

        GalleryCategory::create($validated);

        return redirect()->route('admin.gallery-categories.index')
            ->with('success', 'Kategori galeri berhasil ditambahkan.');
    }

    public function edit(GalleryCategory $galleryCategory)
    {
        return view('admin::gallery-categories.edit', compact('galleryCategory'));
    }

    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:gallery_categories,name,' . $galleryCategory->id,
        ]);

        $galleryCategory->update($validated);

        return redirect()->route('admin.gallery-categories.index')
            ->with('success', 'Kategori galeri berhasil diperbarui.');
    }

    public function destroy(GalleryCategory $galleryCategory)
    {
        // Cek apakah masih ada gallery yang pakai kategori ini
        if ($galleryCategory->galleries()->count() > 0) {
            return redirect()->route('admin.gallery-categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh foto galeri.');
        }

        $galleryCategory->delete();

        return redirect()->route('admin.gallery-categories.index')
            ->with('success', 'Kategori galeri berhasil dihapus.');
    }
}