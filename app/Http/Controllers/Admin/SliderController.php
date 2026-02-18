<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif', 'max:2048'],
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/sliders');
    
            // create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            $image->move($destinationPath, $imageName);
    
            $data['image'] = 'sliders/' . $imageName;
        }
    
        Slider::create($data);
    
        return redirect()
            ->route('admin.sliders.index')
            ->with('status', 'Slider created successfully.');
    }

    public function edit(Slider $slider): View
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,svg,avif', 'max:2048'],
        ]);
    
        if ($request->hasFile('image')) {
    
            // Delete old image from public folder
            if ($slider->image && file_exists(public_path('storage/'.$slider->image))) {
                unlink(public_path('storage/'.$slider->image));
            }
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/sliders');
    
            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Move new image
            $image->move($destinationPath, $imageName);
    
            $data['image'] = 'sliders/' . $imageName;
        } else {
            unset($data['image']);
        }
    
        $slider->update($data);
    
        return redirect()
            ->route('admin.sliders.index')
            ->with('status', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider): RedirectResponse
    {
        // Delete image file
        if ($slider->image && file_exists(public_path('storage/'.$slider->image))) {
                unlink(public_path('storage/'.$slider->image));
            }

        $slider->delete();

        return redirect()
            ->route('admin.sliders.index')
            ->with('status', 'Slider deleted successfully.');
    }
}
