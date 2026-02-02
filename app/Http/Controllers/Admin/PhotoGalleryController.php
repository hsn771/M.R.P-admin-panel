<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoGallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PhotoGalleryController extends Controller
{
    public function index(): View
    {
        $photoGalleries = PhotoGallery::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.photo-galleries.index', compact('photoGalleries'));
    }

    public function create(): View
    {
        return view('admin.photo-galleries.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'],
            'images' => ['required', 'array'],
        ]);
    
        if ($request->hasFile('images')) {
            $images = [];
            $destinationPath = public_path('storage/photo-galleries');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            foreach ($request->file('images') as $image) {
                $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);
                $images[] = 'photo-galleries/' . $imageName;
            }
    
            $data['images'] = $images;
        }
    
        PhotoGallery::create($data);
    
        return redirect()
            ->route('admin.photo-galleries.index')
            ->with('status', 'Photo gallery created successfully.');
    }


    public function edit(PhotoGallery $photoGallery): View
    {
        return view('admin.photo-galleries.edit', compact('photoGallery'));
    }

    public function update(Request $request, PhotoGallery $photoGallery): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'images' => ['nullable', 'array'],
            'remove_images' => ['nullable', 'array'],
        ]);
    
        $currentImages = $photoGallery->images ?? [];

        // Remove selected images
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imagePath) {
                if (file_exists(public_path('storage/' . $imagePath))) {
                    unlink(public_path('storage/' . $imagePath));
                }
                if (($key = array_search($imagePath, $currentImages)) !== false) {
                    unset($currentImages[$key]);
                }
            }
            $currentImages = array_values($currentImages);
        }

        // Add new images
        if ($request->hasFile('images')) {
            $destinationPath = public_path('storage/photo-galleries');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            foreach ($request->file('images') as $image) {
                $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);
                $currentImages[] = 'photo-galleries/' . $imageName;
            }
        }
    
        $data['images'] = $currentImages;
    
        $photoGallery->update($data);
    
        return redirect()
            ->route('admin.photo-galleries.index')
            ->with('status', 'Photo gallery updated successfully.');
    }


    public function destroy(PhotoGallery $photoGallery): RedirectResponse
    {
        // Delete all images
        if ($photoGallery->images && is_array($photoGallery->images)) {
            foreach ($photoGallery->images as $image) {
                if (file_exists(public_path('storage/' . $image))) {
                    unlink(public_path('storage/' . $image));
                }
            }
        }

        $photoGallery->delete();

        return redirect()
            ->route('admin.photo-galleries.index')
            ->with('status', 'Photo gallery deleted successfully.');
    }
}
