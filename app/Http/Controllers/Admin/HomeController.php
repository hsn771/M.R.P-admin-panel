<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $homes = Home::latest()->paginate(15);
        return view('admin.homes.index', compact('homes'));
    }

    public function create(): View
    {
        return view('admin.homes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'points' => ['nullable', 'array'],
            'points.*' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('storage/homes');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'homes/' . $imageName;
        }
        
        // Filter out empty points
        if (isset($data['points']) && is_array($data['points'])) {
            $data['points'] = array_values(array_filter($data['points'], function($value) {
                return !is_null($value) && $value !== '';
            }));
        }

        Home::create($data);

        return redirect()
            ->route('admin.homes.index')
            ->with('status', 'Created successfully.');
    }

    public function show(Home $home): View
    {
        return view('admin.homes.show', compact('home'));
    }

    public function edit(Home $home): View
    {
        return view('admin.homes.edit', compact('home'));
    }

    public function update(Request $request, Home $home): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'points' => ['nullable', 'array'],
            'points.*' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($home->image && file_exists(public_path('storage/' . $home->image))) {
                unlink(public_path('storage/' . $home->image));
            }

            $destinationPath = public_path('storage/homes');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'homes/' . $imageName;
        }

        // Filter out empty points
        if (isset($data['points']) && is_array($data['points'])) {
            $data['points'] = array_values(array_filter($data['points'], function($value) {
                return !is_null($value) && $value !== '';
            }));
        }

        $home->update($data);

        return redirect()
            ->route('admin.homes.index')
            ->with('status', 'Updated successfully.');
    }

    public function destroy(Home $home): RedirectResponse
    {
        if ($home->image && file_exists(public_path('storage/' . $home->image))) {
            unlink(public_path('storage/' . $home->image));
        }

        $home->delete();

        return redirect()
            ->route('admin.homes.index')
            ->with('status', 'Deleted successfully.');
    }
}
