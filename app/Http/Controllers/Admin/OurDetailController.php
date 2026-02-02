<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OurDetailController extends Controller
{
    public function index(): View
    {
        $ourDetails = OurDetail::latest()->paginate(15);
        return view('admin.our-details.index', compact('ourDetails'));
    }

    public function show(OurDetail $ourDetail): View
    {
        return view('admin.our-details.show', compact('ourDetail'));
    }

    public function create(): View
    {
        return view('admin.our-details.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'our_address' => 'required|string|max:255',
            'our_phone' => 'required|string|max:255',
            'our_email' => 'required|email|max:255',
            'fb_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
        ]);

        OurDetail::create($data);

        return redirect()->route('admin.our-details.index')
            ->with('status', 'Our Detail created successfully.');
    }

    public function edit(OurDetail $ourDetail): View
    {
        return view('admin.our-details.edit', compact('ourDetail'));
    }

    public function update(Request $request, OurDetail $ourDetail): RedirectResponse
    {
        $data = $request->validate([
            'our_address' => 'required|string|max:255',
            'our_phone' => 'required|string|max:255',
            'our_email' => 'required|email|max:255',
            'fb_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
        ]);

        $ourDetail->update($data);

        return redirect()->route('admin.our-details.index')
            ->with('status', 'Our Detail updated successfully.');
    }

    public function destroy(OurDetail $ourDetail): RedirectResponse
    {
        $ourDetail->delete();

        return redirect()->route('admin.our-details.index')
            ->with('status', 'Our Detail deleted successfully.');
    }
}
