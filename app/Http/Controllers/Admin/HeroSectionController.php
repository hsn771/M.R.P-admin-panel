<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HeroSectionController extends Controller
{
    public function index(): View
    {
        $heroSections = HeroSection::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.hero-sections.index', compact('heroSections'));
    }

    public function create(): View
    {
        return view('admin.hero-sections.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif', 'max:2048'],
            'description' => ['required', 'string'],
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/hero-sections');
    
            // Create directory if it does not exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Move image to public folder
            $image->move($destinationPath, $imageName);
    
            // Save relative path in database
            $data['image'] = 'hero-sections/' . $imageName;
        }
    
        HeroSection::create($data);
    
        return redirect()
            ->route('admin.hero-sections.index')
            ->with('status', 'Hero section created successfully.');
    }


    public function edit(HeroSection $heroSection): View
    {
        return view('admin.hero-sections.edit', compact('heroSection'));
    }

    public function update(Request $request, HeroSection $heroSection): RedirectResponse
{
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif', 'max:2048'],
        'description' => ['required', 'string'],
    ]);

    if ($request->hasFile('image')) {

        // Delete old image from public folder
        if ($heroSection->image && file_exists(public_path('storage/'.$heroSection->image))) {
            unlink(public_path('storage/'.$heroSection->image));
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('storage/hero-sections');

        // Create directory if it does not exist
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Move new image to public folder
        $image->move($destinationPath, $imageName);

        // Save relative path in database
        $data['image'] = 'hero-sections/' . $imageName;
    } else {
        unset($data['image']);
    }

    $heroSection->update($data);

    return redirect()
        ->route('admin.hero-sections.index')
        ->with('status', 'Hero section updated successfully.');
}


    public function destroy(HeroSection $heroSection): RedirectResponse
    {
        // Delete image file
       if ($heroSection->image && file_exists(public_path('storage/'.$heroSection->image))) {
            unlink(public_path('storage/'.$heroSection->image));
        }

        $heroSection->delete();

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('status', 'Hero section deleted successfully.');
    }
}
