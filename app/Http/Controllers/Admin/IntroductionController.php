<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Introduction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IntroductionController extends Controller
{
    public function index(): View
    {
        $introductions = Introduction::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.introductions.index', compact('introductions'));
    }

    public function create(): View
    {
        return view('admin.introductions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        Introduction::create($data);

        return redirect()
            ->route('admin.introductions.index')
            ->with('status', 'Introduction created successfully.');
    }

    public function edit(Introduction $introduction): View
    {
        return view('admin.introductions.edit', compact('introduction'));
    }

    public function update(Request $request, Introduction $introduction): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $introduction->update($data);

        return redirect()
            ->route('admin.introductions.index')
            ->with('status', 'Introduction updated successfully.');
    }

    public function destroy(Introduction $introduction): RedirectResponse
    {
        $introduction->delete();

        return redirect()
            ->route('admin.introductions.index')
            ->with('status', 'Introduction deleted successfully.');
    }
}
