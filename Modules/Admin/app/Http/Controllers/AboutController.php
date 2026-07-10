<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\About\Models\AboutUs;

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

        return view('admin::about.edit', compact('about'));
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
}
