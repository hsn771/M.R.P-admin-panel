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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'title' => 'nullable|string|max:255',
            'footer_description' => 'nullable|string',
            'our_address' => 'required|string|max:255',
            'our_phone' => 'required|string|max:255',
            'our_email' => 'required|email|max:255',
            'fb_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            $destinationPath = public_path('storage/our-details');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image = $request->file('logo');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['logo'] = 'our-details/' . $imageName;
        }

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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'title' => 'nullable|string|max:255',
            'footer_description' => 'nullable|string',
            'our_address' => 'required|string|max:255',
            'our_phone' => 'required|string|max:255',
            'our_email' => 'required|email|max:255',
            'fb_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old image
            if ($ourDetail->logo && file_exists(public_path('storage/' . $ourDetail->logo))) {
                unlink(public_path('storage/' . $ourDetail->logo));
            }

            $destinationPath = public_path('storage/our-details');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image = $request->file('logo');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['logo'] = 'our-details/' . $imageName;
        }

        $ourDetail->update($data);

        return redirect()->route('admin.our-details.index')
            ->with('status', 'Our Detail updated successfully.');
    }

    public function destroy(OurDetail $ourDetail): RedirectResponse
    {
        if ($ourDetail->logo && file_exists(public_path('storage/' . $ourDetail->logo))) {
            unlink(public_path('storage/' . $ourDetail->logo));
        }

        $ourDetail->delete();

        return redirect()->route('admin.our-details.index')
            ->with('status', 'Our Detail deleted successfully.');
    }
}
