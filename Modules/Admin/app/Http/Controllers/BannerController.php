<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Banner\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->paginate(10);
        return view('admin::banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin::banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cta_text'    => 'nullable|string|max:255',
            'cta_link'    => 'nullable|string|max:255',
            'order'       => 'nullable|integer|min:0',
            'status'      => 'required|in:active,inactive',
        ]);

        $path = $request->file('image')->store('banners', 'public');
        $validated['image'] = basename($path);

        Banner::create($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin::banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $rules = [
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cta_text'    => 'nullable|string|max:255',
            'cta_link'    => 'nullable|string|max:255',
            'order'       => 'nullable|integer|min:0',
            'status'      => 'required|in:active,inactive',
        ];

        $validated = $request->validate($rules);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($banner->image) {
                Storage::disk('public')->delete('banners/' . $banner->image);
            }
            $path = $request->file('image')->store('banners', 'public');
            $validated['image'] = basename($path);
        } else {
            unset($validated['image']);
        }

        $banner->update($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete('banners/' . $banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner berhasil dihapus.');
    }
}