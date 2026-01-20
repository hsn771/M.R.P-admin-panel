<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $abouts = About::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.abouts.index', compact('abouts'));
    }

    public function create(): View
    {
        return view('admin.abouts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        About::create($data);

        return redirect()
            ->route('admin.abouts.index')
            ->with('status', 'About created successfully.');
    }

    public function edit(About $about): View
    {
        return view('admin.abouts.edit', compact('about'));
    }

    public function update(Request $request, About $about): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $about->update($data);

        return redirect()
            ->route('admin.abouts.index')
            ->with('status', 'About updated successfully.');
    }

    public function destroy(About $about): RedirectResponse
    {
        $about->delete();

        return redirect()
            ->route('admin.abouts.index')
            ->with('status', 'About deleted successfully.');
    }
}
