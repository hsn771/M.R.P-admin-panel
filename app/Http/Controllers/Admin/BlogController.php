<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif', 'max:2048'],
            'description' => ['required', 'string'],
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/blogs');
    
            // Create directory if it does not exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Move image to public folder
            $image->move($destinationPath, $imageName);
    
            // Save relative path in database
            $data['image'] = 'blogs/' . $imageName;
        }
    
        Blog::create($data);
    
        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog created successfully.');
    }


    public function edit(Blog $blog): View
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif', 'max:2048'],
            'description' => ['required', 'string'],
        ]);
    
        if ($request->hasFile('image')) {
    
            // Delete old image from public folder
            if ($blog->image && file_exists(public_path('storage/'.$blog->image))) {
                unlink(public_path('storage/'.$blog->image));
            }
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/blogs');
    
            // Create directory if it does not exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Move new image to public folder
            $image->move($destinationPath, $imageName);
    
            // Save relative path in database
            $data['image'] = 'blogs/' . $imageName;
        } else {
            unset($data['image']);
        }
    
        $blog->update($data);
    
        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog updated successfully.');
    }


    public function destroy(Blog $blog): RedirectResponse
    {
        // Delete image file
        if ($blog->image && file_exists(public_path('storage/'.$blog->image))) {
            unlink(public_path('storage/'.$blog->image));
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog deleted successfully.');
    }
}
