<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WomanEmpowerCard;
use App\Models\WomanEmpowerFormImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WomanEmpowerCardController extends Controller
{
    public function index(): View
    {
        $cards = WomanEmpowerCard::orderBy('created_at', 'desc')->paginate(15);
        $formImage = WomanEmpowerFormImage::latest()->first();

        return view('admin.woman-empower-cards.index', compact('cards', 'formImage'));
    }

    public function show(WomanEmpowerCard $womanEmpowerCard): View
    {
        return view('admin.woman-empower-cards.show', compact('womanEmpowerCard'));
    }

    public function destroy(WomanEmpowerCard $womanEmpowerCard): RedirectResponse
    {
        $womanEmpowerCard->delete();

        return redirect()
            ->route('admin.woman-empower-cards.index')
            ->with('status', 'Woman empower card deleted successfully.');
    }

    public function updateFormImage(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        // Get or create the form image record (only one record)
        $formImage = WomanEmpowerFormImage::first();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($formImage && $formImage->image && Storage::disk('public')->exists($formImage->image)) {
                Storage::disk('public')->delete($formImage->image);
            }

            $imagePath = $request->file('image')->store('woman-empower-form-images', 'public');
            $data['image'] = $imagePath;
        }

        if ($formImage) {
            $formImage->update($data);
        } else {
            WomanEmpowerFormImage::create($data);
        }

        return redirect()
            ->route('admin.woman-empower-cards.index')
            ->with('status', 'Form image updated successfully.');
    }
}
