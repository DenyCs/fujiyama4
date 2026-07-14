<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SectionContent\Models\SectionContent;

class SectionContentController extends Controller
{
    /**
     * Show the edit form for all sections.
     */
    public function edit()
    {
        $sections = SectionContent::all()->keyBy('section_key');

        return view('admin::section-content.edit', compact('sections'));
    }

    /**
     * Update all section contents.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'sections' => ['required', 'array'],
            'sections.*.badge_text' => ['nullable', 'string', 'max:255'],
            'sections.*.title' => ['required', 'string', 'max:255'],
            'sections.*.subtitle' => ['nullable', 'string', 'max:500'],
        ]);

        foreach ($validated['sections'] as $key => $data) {
            SectionContent::updateOrCreate(
                ['section_key' => $key],
                $data
            );
        }

        return redirect()->route('admin.section-content.edit')
            ->with('success', 'Konten section berhasil diperbarui.');
    }
}