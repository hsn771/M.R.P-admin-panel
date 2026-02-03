<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurInitial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OurInitialController extends Controller
{
    public function index(): View
    {
        $ourInitials = OurInitial::latest()->paginate(15);
        return view('admin.our-initials.index', compact('ourInitials'));
    }

    public function create(): View
    {
        return view('admin.our-initials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('storage/our-initials');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'our-initials/' . $imageName;
        }

        OurInitial::create($data);

        return redirect()
            ->route('admin.our-initials.index')
            ->with('status', 'Created successfully.');
    }

    public function show(OurInitial $ourInitial): View
    {
        return view('admin.our-initials.show', compact('ourInitial'));
    }

    public function edit(OurInitial $ourInitial): View
    {
        return view('admin.our-initials.edit', compact('ourInitial'));
    }

    public function update(Request $request, OurInitial $ourInitial): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($ourInitial->image && file_exists(public_path('storage/' . $ourInitial->image))) {
                unlink(public_path('storage/' . $ourInitial->image));
            }

            $destinationPath = public_path('storage/our-initials');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'our-initials/' . $imageName;
        }

        $ourInitial->update($data);

        return redirect()
            ->route('admin.our-initials.index')
            ->with('status', 'Updated successfully.');
    }

    public function destroy(OurInitial $ourInitial): RedirectResponse
    {
        if ($ourInitial->image && file_exists(public_path('storage/' . $ourInitial->image))) {
            unlink(public_path('storage/' . $ourInitial->image));
        }

        $ourInitial->delete();

        return redirect()
            ->route('admin.our-initials.index')
            ->with('status', 'Deleted successfully.');
    }
}
