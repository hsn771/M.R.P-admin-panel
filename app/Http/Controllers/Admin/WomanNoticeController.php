<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WomanNotice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WomanNoticeController extends Controller
{
    public function index(): View
    {
        $womanNotices = WomanNotice::orderBy('date', 'desc')->paginate(15);

        return view('admin.woman-notices.index', compact('womanNotices'));
    }

    public function create(): View
    {
        return view('admin.woman-notices.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
        ]);

        WomanNotice::create($data);

        return redirect()
            ->route('admin.woman-notices.index')
            ->with('status', 'Woman notice created successfully.');
    }

    public function edit(WomanNotice $womanNotice): View
    {
        return view('admin.woman-notices.edit', compact('womanNotice'));
    }

    public function update(Request $request, WomanNotice $womanNotice): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
        ]);

        $womanNotice->update($data);

        return redirect()
            ->route('admin.woman-notices.index')
            ->with('status', 'Woman notice updated successfully.');
    }

    public function destroy(WomanNotice $womanNotice): RedirectResponse
    {
        $womanNotice->delete();

        return redirect()
            ->route('admin.woman-notices.index')
            ->with('status', 'Woman notice deleted successfully.');
    }
}
