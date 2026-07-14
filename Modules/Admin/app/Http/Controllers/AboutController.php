<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\About\Models\AboutUs;
use Modules\About\Models\AboutGallery;
use Modules\About\Models\GalleryCategory;

class AboutController extends Controller
{
    /**
     * Show the single edit form for AboutUs text content.
     * This is a singleton page — no index, no create, no show.
     * Gallery management has been moved to GalleryController (/admin/gallery).
     */
    public function edit()
    {
        $about = AboutUs::getContent();
        $galleries = AboutGallery::with('galleryCategory')->orderBy('order')->get();
        $categories = GalleryCategory::orderBy('name')->get();

        $photos = $galleries->map(fn($g) => [
            'id' => $g->id,
            'image_url' => $g->image_url,
            'caption' => $g->caption,
            'gallery_category_id' => $g->gallery_category_id,
            'category_name' => $g->galleryCategory?->name ?? '',
        ])->values();

        return view('admin::about.edit', compact('about', 'galleries', 'categories', 'photos'));
    }

    /**
     * Update the singleton AboutUs text content.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title'              => 'required|string|max:255',
            'subtitle'           => 'nullable|string|max:255',
            'story'              => 'nullable|string',
            'primary_photo_id'   => 'nullable|integer|exists:about_gallery,id',
            'secondary_photo_id' => 'nullable|integer|exists:about_gallery,id',
        ]);

        $about = AboutUs::getContent();
        $about->update($validated);

        return redirect()->route('admin.about.edit')
            ->with('success', 'Informasi Tentang Kami berhasil diperbarui.');
    }

    /**
     * Show the photo picker page for a specific slot ("utama" or "sekunder").
     * This is a FULL PAGE, NOT a modal — avoids CSS positioning bugs.
     */
    public function pilihFoto(string $slot)
    {
        if (!in_array($slot, ['utama', 'sekunder'])) {
            abort(404);
        }

        $about = AboutUs::getContent();
        $galleries = AboutGallery::with('galleryCategory')->orderBy('order')->paginate(12);
        $categories = GalleryCategory::orderBy('name')->get();

        $label = $slot === 'utama' ? 'Utama' : 'Sekunder';
        $currentId = $slot === 'utama' ? $about->primary_photo_id : $about->secondary_photo_id;

        return view('admin::about.pilih-foto', compact(
            'slot', 'label', 'about', 'galleries', 'categories', 'currentId'
        ));
    }

    /**
     * Select a photo for a slot and redirect back to about edit page.
     * URL: GET /admin/about/simpan-foto/{slot}/{photo}
     * {photo} is photo ID or 0 for "no photo".
     */
    public function simpanFoto(string $slot, string $photo)
    {
        if (!in_array($slot, ['utama', 'sekunder'])) {
            abort(404);
        }

        $photoId = (int) $photo;
        $about = AboutUs::getContent();

        if ($photoId === 0) {
            // "Tanpa Foto" selected
            $field = $slot === 'utama' ? 'primary_photo_id' : 'secondary_photo_id';
            $about->update([$field => null]);
        } else {
            // Validate photo exists
            $gallery = AboutGallery::findOrFail($photoId);
            $field = $slot === 'utama' ? 'primary_photo_id' : 'secondary_photo_id';
            $about->update([$field => $gallery->id]);
        }

        $label = $slot === 'utama' ? 'utama' : 'sekunder';
        return redirect()->route('admin.about.edit')
            ->with('success', "Foto {$label} berhasil dipilih.");
    }
}
