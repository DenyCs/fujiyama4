<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Faq\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the FAQ.
     */
    public function index()
    {
        $faqs = Faq::withoutGlobalScope('ordered')
            ->orderBy('order', 'asc')
            ->get();

        return view('admin::faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create()
    {
        return view('admin::faqs.create');
    }

    /**
     * Store a newly created FAQ.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'order'    => 'nullable|integer|min:0',
            'status'   => 'required|in:active,inactive',
        ]);

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit(Faq $faq)
    {
        return view('admin::faqs.edit', compact('faq'));
    }

    /**
     * Update the specified FAQ.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'order'    => 'nullable|integer|min:0',
            'status'   => 'required|in:active,inactive',
        ]);

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Remove the specified FAQ.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil dihapus.');
    }
}