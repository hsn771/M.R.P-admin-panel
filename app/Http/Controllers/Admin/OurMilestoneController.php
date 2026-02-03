<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurMilestone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OurMilestoneController extends Controller
{
    public function index(): View
    {
        $ourMilestones = OurMilestone::latest()->paginate(15);
        return view('admin.our-milestones.index', compact('ourMilestones'));
    }

    public function create(): View
    {
        return view('admin.our-milestones.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'year' => ['required', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        OurMilestone::create($data);

        return redirect()
            ->route('admin.our-milestones.index')
            ->with('status', 'Created successfully.');
    }

    public function show(OurMilestone $ourMilestone): View
    {
        return view('admin.our-milestones.show', compact('ourMilestone'));
    }

    public function edit(OurMilestone $ourMilestone): View
    {
        return view('admin.our-milestones.edit', compact('ourMilestone'));
    }

    public function update(Request $request, OurMilestone $ourMilestone): RedirectResponse
    {
        $data = $request->validate([
            'year' => ['required', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $ourMilestone->update($data);

        return redirect()
            ->route('admin.our-milestones.index')
            ->with('status', 'Updated successfully.');
    }

    public function destroy(OurMilestone $ourMilestone): RedirectResponse
    {
        $ourMilestone->delete();

        return redirect()
            ->route('admin.our-milestones.index')
            ->with('status', 'Deleted successfully.');
    }
}
