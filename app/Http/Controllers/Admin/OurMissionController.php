<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurMission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OurMissionController extends Controller
{
    public function index(): View
    {
        $ourMissions = OurMission::latest()->paginate(15);
        return view('admin.our-missions.index', compact('ourMissions'));
    }

    public function create(): View
    {
        return view('admin.our-missions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif', 'max:20480'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'points' => ['nullable', 'array'],
            'points.*' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('storage/our-missions');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'our-missions/' . $imageName;
        }
        
        // Filter out empty points if any
        if (isset($data['points']) && is_array($data['points'])) {
            $data['points'] = array_filter($data['points'], function($value) {
                return !is_null($value) && $value !== '';
            });
            // Re-index array
            $data['points'] = array_values($data['points']);
        }

        OurMission::create($data);

        return redirect()
            ->route('admin.our-missions.index')
            ->with('status', 'Created successfully.');
    }

    public function show(OurMission $ourMission): View
    {
        return view('admin.our-missions.show', compact('ourMission'));
    }

    public function edit(OurMission $ourMission): View
    {
        return view('admin.our-missions.edit', compact('ourMission'));
    }

    public function update(Request $request, OurMission $ourMission): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg', 'max:20480'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'points' => ['nullable', 'array'],
            'points.*' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($ourMission->image && file_exists(public_path('storage/' . $ourMission->image))) {
                unlink(public_path('storage/' . $ourMission->image));
            }

            $destinationPath = public_path('storage/our-missions');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'our-missions/' . $imageName;
        }

        // Filter out empty points if any
        if (isset($data['points']) && is_array($data['points'])) {
            $data['points'] = array_filter($data['points'], function($value) {
                return !is_null($value) && $value !== '';
            });
            // Re-index array
            $data['points'] = array_values($data['points']);
        }

        $ourMission->update($data);

        return redirect()
            ->route('admin.our-missions.index')
            ->with('status', 'Updated successfully.');
    }

    public function destroy(OurMission $ourMission): RedirectResponse
    {
        if ($ourMission->image && file_exists(public_path('storage/' . $ourMission->image))) {
            unlink(public_path('storage/' . $ourMission->image));
        }

        $ourMission->delete();

        return redirect()
            ->route('admin.our-missions.index')
            ->with('status', 'Deleted successfully.');
    }
}
