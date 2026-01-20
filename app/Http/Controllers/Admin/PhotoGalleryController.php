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
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/photo-galleries');
    
            // Create directory if it does not exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Move image to public folder
            $image->move($destinationPath, $imageName);
    
            // Save relative path in database
            $data['image'] = 'photo-galleries/' . $imageName;
        }
    
        PhotoGallery::create($data);
    
        return redirect()
            ->route('admin.photo-galleries.index')
            ->with('status', 'Photo added to gallery successfully.');
    }


    public function edit(PhotoGallery $photoGallery): View
    {
        return view('admin.photo-galleries.edit', compact('photoGallery'));
    }

    public function update(Request $request, PhotoGallery $photoGallery): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);
    
        if ($request->hasFile('image')) {
    
            // Delete old image from public folder
            if ($photoGallery->image && file_exists(public_path('storage/'.$photoGallery->image))) {
                unlink(public_path('storage/'.$photoGallery->image));
            }
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/photo-galleries');
    
            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Move new image
            $image->move($destinationPath, $imageName);
    
            // Save relative path
            $data['image'] = 'photo-galleries/' . $imageName;
        } else {
            unset($data['image']);
        }
    
        $photoGallery->update($data);
    
        return redirect()
            ->route('admin.photo-galleries.index')
            ->with('status', 'Photo updated successfully.');
    }


    public function destroy(PhotoGallery $photoGallery): RedirectResponse
    {
        // Delete image file
        if ($photoGallery->image && file_exists(public_path('storage/'.$photoGallery->image))) {
            unlink(public_path('storage/'.$photoGallery->image));
        }

        $photoGallery->delete();

        return redirect()
            ->route('admin.photo-galleries.index')
            ->with('status', 'Photo deleted successfully.');
    }
}
