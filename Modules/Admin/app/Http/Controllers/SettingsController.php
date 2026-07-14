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

    /**
     * Show the footer settings form.
     */
    public function editFooter()
    {
        $setting = RestaurantSetting::getContent();

        return view('admin::settings.footer', compact('setting'));
    }

    /**
     * Update footer settings.
     */
    public function updateFooter(Request $request)
    {
        $validated = $request->validate([
            'footer_description' => 'nullable|string|max:2000',
            'copyright_text'     => 'nullable|string|max:255',
        ]);

        $setting = RestaurantSetting::getContent();
        $setting->update($validated);

        return redirect()
            ->route('admin.settings.footer.edit')
            ->with('success', 'Pengaturan footer berhasil disimpan.');
    }

    /**
     * Show the branding settings form (logo & favicon).
     */
    public function branding()
    {
        $setting = RestaurantSetting::getContent();

        return view('admin::settings.branding', compact('setting'));
    }

    /**
     * Update branding settings (logo & favicon upload).
     */
    public function updateBranding(Request $request)
    {
        $validated = $request->validate([
            'logo_dark'     => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'logo_light'    => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'favicon_image' => 'nullable|image|mimes:png,ico,svg|max:512',
        ]);

        $setting = RestaurantSetting::getContent();
        $data = [];

        if ($request->hasFile('logo_dark')) {
            // Delete old dark logo if exists
            if ($setting->logo_dark && file_exists(public_path($setting->logo_dark))) {
                unlink(public_path($setting->logo_dark));
            }
            $logoPath = $request->file('logo_dark')->store('branding', 'public');
            $data['logo_dark'] = 'storage/' . $logoPath;
        }

        if ($request->hasFile('logo_light')) {
            // Delete old light logo if exists
            if ($setting->logo_light && file_exists(public_path($setting->logo_light))) {
                unlink(public_path($setting->logo_light));
            }
            $logoPath = $request->file('logo_light')->store('branding', 'public');
            $data['logo_light'] = 'storage/' . $logoPath;
        }

        if ($request->hasFile('favicon_image')) {
            // Delete old favicon if exists
            if ($setting->favicon_image && file_exists(public_path($setting->favicon_image))) {
                unlink(public_path($setting->favicon_image));
            }
            $faviconPath = $request->file('favicon_image')->store('branding', 'public');
            $data['favicon_image'] = 'storage/' . $faviconPath;
        }

        if (! empty($data)) {
            $setting->update($data);
        }

        return redirect()
            ->route('admin.settings.branding')
            ->with('success', 'Pengaturan branding (logo & favicon) berhasil disimpan.');
    }
}
