<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestSubmission;
use App\Models\RequestFormImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RequestSubmissionController extends Controller
{
    public function index(): View
    {
        $submissions = RequestSubmission::orderBy('created_at', 'desc')->paginate(15);
        $formImage = RequestFormImage::latest()->first();

        return view('admin.request-submissions.index', compact('submissions', 'formImage'));
    }

    public function show(RequestSubmission $requestSubmission): View
    {
        return view('admin.request-submissions.show', compact('requestSubmission'));
    }

    public function edit(RequestSubmission $requestSubmission): View
    {
        return view('admin.request-submissions.edit', compact('requestSubmission'));
    }

    public function update(Request $request, RequestSubmission $requestSubmission): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'string', 'in:চলমান,মীমাংসিত,অমীমাংসিত'],
        ]);

        $requestSubmission->update($data);

        return redirect()
            ->route('admin.request-submissions.show', $requestSubmission)
            ->with('status', 'Request submission status updated successfully.');
    }

    public function destroy(RequestSubmission $requestSubmission): RedirectResponse
    {
        $requestSubmission->delete();

        return redirect()
            ->route('admin.request-submissions.index')
            ->with('status', 'Request submission deleted successfully.');
    }

    public function updateFormImage(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        // Get or create the form image record (only one record)
        $formImage = RequestFormImage::first();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($formImage && $formImage->image && Storage::disk('public')->exists($formImage->image)) {
                Storage::disk('public')->delete($formImage->image);
            }

            $imagePath = $request->file('image')->store('request-form-images', 'public');
            $data['image'] = $imagePath;
        }

        if ($formImage) {
            $formImage->update($data);
        } else {
            RequestFormImage::create($data);
        }

        return redirect()
            ->route('admin.request-submissions.index')
            ->with('status', 'Form image updated successfully.');
    }
}
