@extends('layouts.admin')

@section('title', 'Edit video')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit video</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.video-galleries.update', $videoGallery) }}" enctype="multipart/form-data" style="max-width:480px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="video" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Video</label>
                @if($videoGallery->video)
                    <div style="margin-bottom:0.5rem;">
                        <video src="{{ asset('storage/' . $videoGallery->video) }}" 
                               style="width:300px; height:200px; border-radius:0.25rem; border:1px solid #d1d5db;" 
                               controls>
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif
                <input id="video" name="video" type="file" accept="video/*"
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                <div class="muted" style="margin-top:0.25rem; font-size:0.75rem;">
                    Accepted formats: MP4, MOV, AVI, WMV, FLV, WEBM. Max size: 10MB. Leave blank to keep current video.
                </div>
                @error('video')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('admin.video-galleries.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection

