<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setting\Models\RestaurantSetting;

class SettingsController extends Controller
{
    /**
     * Show the location & hours settings form (singleton — direct to edit).
     */
    public function edit()
    {
        $setting = RestaurantSetting::getContent();

        // Decode JSON if it's a string (from DB)
        if (is_string($setting->opening_hours)) {
            $setting->opening_hours = json_decode($setting->opening_hours, true) ?? [];
        }

        return view('admin::settings.location', compact('setting'));
    }

    /**
     * Update location & hours settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'address'               => 'nullable|string|max:2000',
            'phone'                 => 'nullable|string|max:20',
            'google_maps_embed_url' => 'nullable|url|max:2000',
            'opening_hours'         => 'nullable|array',
            'opening_hours.*'       => 'nullable|string|max:50',
        ]);

        $setting = RestaurantSetting::getContent();

        $setting->update([
            'address'               => $validated['address'] ?? null,
            'phone'                 => $validated['phone'] ?? null,
            'google_maps_embed_url' => $validated['google_maps_embed_url'] ?? null,
            'opening_hours'         => $validated['opening_hours'] ?? [],
        ]);

        return redirect()
            ->route('admin.settings.location.edit')
            ->with('success', 'Pengaturan lokasi & jam buka berhasil disimpan.');
    }
}