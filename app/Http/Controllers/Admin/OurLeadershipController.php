<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurLeadership;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OurLeadershipController extends Controller
{
    public function index(): View
    {
        $ourLeaderships = OurLeadership::latest()->paginate(15);
        return view('admin.our-leaderships.index', compact('ourLeaderships'));
    }

    public function create(): View
    {
        return view('admin.our-leaderships.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif'],
            'name' => ['required', 'string', 'max:255'],
            'post' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('storage/our-leaderships');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'our-leaderships/' . $imageName;
        }

        OurLeadership::create($data);

        return redirect()
            ->route('admin.our-leaderships.index')
            ->with('status', 'Created successfully.');
    }

    public function show(OurLeadership $ourLeadership): View
    {
        return view('admin.our-leaderships.show', compact('ourLeadership'));
    }

    public function edit(OurLeadership $ourLeadership): View
    {
        return view('admin.our-leaderships.edit', compact('ourLeadership'));
    }

    public function update(Request $request, OurLeadership $ourLeadership): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif'],
            'name' => ['required', 'string', 'max:255'],
            'post' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($ourLeadership->image && file_exists(public_path('storage/' . $ourLeadership->image))) {
                unlink(public_path('storage/' . $ourLeadership->image));
            }

            $destinationPath = public_path('storage/our-leaderships');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'our-leaderships/' . $imageName;
        }

        $ourLeadership->update($data);

        return redirect()
            ->route('admin.our-leaderships.index')
            ->with('status', 'Updated successfully.');
    }

    public function destroy(OurLeadership $ourLeadership): RedirectResponse
    {
        if ($ourLeadership->image && file_exists(public_path('storage/' . $ourLeadership->image))) {
            unlink(public_path('storage/' . $ourLeadership->image));
        }

        $ourLeadership->delete();

        return redirect()
            ->route('admin.our-leaderships.index')
            ->with('status', 'Deleted successfully.');
    }
}
