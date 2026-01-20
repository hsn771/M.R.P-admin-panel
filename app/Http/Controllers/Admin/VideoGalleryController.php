<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VideoGalleryController extends Controller
{
    public function index(): View
    {
        $videoGalleries = VideoGallery::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.video-galleries.index', compact('videoGalleries'));
    }

    public function create(): View
    {
        return view('admin.video-galleries.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'video' => ['required', 'mimes:mp4,mov,avi,wmv,flv,webm', 'max:102400'], // 100MB
        ]);
    
        if ($request->hasFile('video')) {
            $video = $request->file('video');
    
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('storage/video-galleries');
    
            // Create directory if it does not exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Move video to public folder
            $video->move($destinationPath, $videoName);
    
            // Save relative path in database
            $data['video'] = 'video-galleries/' . $videoName;
        }
    
        VideoGallery::create($data);
    
        return redirect()
            ->route('admin.video-galleries.index')
            ->with('status', 'Video added to gallery successfully.');
    }


    public function edit(VideoGallery $videoGallery): View
    {
        return view('admin.video-galleries.edit', compact('videoGallery'));
    }

    public function update(Request $request, VideoGallery $videoGallery): RedirectResponse
    {
        $data = $request->validate([
            'video' => ['nullable', 'mimes:mp4,mov,avi,wmv,flv,webm', 'max:102400'], // 100MB
        ]);
    
        if ($request->hasFile('video')) {
    
            // Delete old video from public folder
            if ($videoGallery->video && file_exists(public_path('storage/'.$videoGallery->video))) {
                unlink(public_path('storage/'.$videoGallery->video));
            }
    
            $video = $request->file('video');
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('storage/video-galleries');
    
            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Move new video
            $video->move($destinationPath, $videoName);
    
            // Save relative path in database
            $data['video'] = 'video-galleries/' . $videoName;
        } else {
            unset($data['video']);
        }
    
        $videoGallery->update($data);
    
        return redirect()
            ->route('admin.video-galleries.index')
            ->with('status', 'Video updated successfully.');
    }


    public function destroy(VideoGallery $videoGallery): RedirectResponse
    {
        // Delete video file
        if ($videoGallery->video && file_exists(public_path('storage/'.$videoGallery->video))) {
            unlink(public_path('storage/'.$videoGallery->video));
        }
        $videoGallery->delete();

        return redirect()
            ->route('admin.video-galleries.index')
            ->with('status', 'Video deleted successfully.');
    }
}
