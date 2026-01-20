<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MissionController extends Controller
{
    public function index(): View
    {
        $missions = Mission::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.missions.index', compact('missions'));
    }

    public function create(): View
    {
        return view('admin.missions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subjects' => ['required', 'array', 'min:1'],
            'subjects.*' => ['required', 'string'],
        ]);

        // Join subjects with newlines
        $data['subject'] = implode("\n", array_filter(array_map('trim', $data['subjects'])));
        unset($data['subjects']);

        Mission::create($data);

        return redirect()
            ->route('admin.missions.index')
            ->with('status', 'Mission created successfully.');
    }

    public function edit(Mission $mission): View
    {
        return view('admin.missions.edit', compact('mission'));
    }

    public function update(Request $request, Mission $mission): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subjects' => ['required', 'array', 'min:1'],
            'subjects.*' => ['required', 'string'],
        ]);

        // Join subjects with newlines
        $data['subject'] = implode("\n", array_filter(array_map('trim', $data['subjects'])));
        unset($data['subjects']);

        $mission->update($data);

        return redirect()
            ->route('admin.missions.index')
            ->with('status', 'Mission updated successfully.');
    }

    public function destroy(Mission $mission): RedirectResponse
    {
        $mission->delete();

        return redirect()
            ->route('admin.missions.index')
            ->with('status', 'Mission deleted successfully.');
    }
}
