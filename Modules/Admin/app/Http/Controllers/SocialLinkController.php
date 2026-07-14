<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Models\SocialLink;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::ordered()->get();
        return view('admin::social-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin::social-links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url'      => 'required|url|max:255',
            'icon'     => 'nullable|string|max:255',
            'order'    => 'nullable|integer|min:0',
            'status'   => 'required|in:active,inactive',
        ]);

        SocialLink::create($validated);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link berhasil ditambahkan.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin::social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url'      => 'required|url|max:255',
            'icon'     => 'nullable|string|max:255',
            'order'    => 'nullable|integer|min:0',
            'status'   => 'required|in:active,inactive',
        ]);

        $socialLink->update($validated);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link berhasil diperbarui.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link berhasil dihapus.');
    }
}