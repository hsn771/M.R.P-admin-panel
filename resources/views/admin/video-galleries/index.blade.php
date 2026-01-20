@extends('layouts.admin')

@section('title', 'Video Galleries')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Video Galleries</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage video gallery videos.</div>
            <a href="{{ route('admin.video-galleries.create') }}" class="btn btn-primary">Add video</a>
        </div>

        @if (session('status'))
            <div style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('status') }}
            </div>
        @endif

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
            <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                <th style="padding:0.5rem 0.25rem;">ID</th>
                <th style="padding:0.5rem 0.25rem;">Video</th>
                <th style="padding:0.5rem 0.25rem;">Created</th>
                <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($videoGalleries as $videoGallery)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:0.5rem 0.25rem;">{{ $videoGallery->id }}</td>
                    <td style="padding:0.5rem 0.25rem;">
                        @if($videoGallery->video)
                            <video src="{{ asset('storage/' . $videoGallery->video) }}" 
                                   style="width:150px; height:100px; object-fit:cover; border-radius:0.25rem;" 
                                   controls>
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <span class="muted">No video</span>
                        @endif
                    </td>
                    <td style="padding:0.5rem 0.25rem;">{{ $videoGallery->created_at->format('M d, Y') }}</td>
                    <td style="padding:0.5rem 0.25rem; text-align:right;">
                        <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                            <a href="{{ route('admin.video-galleries.edit', $videoGallery) }}" class="btn btn-outline">Edit</a>
                            <form action="{{ route('admin.video-galleries.destroy', $videoGallery) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" 
                                        style="color:#b91c1c; border-color:#b91c1c;"
                                        onclick="return confirm('Are you sure you want to delete this video?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                        No videos found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:0.75rem;">
            {{ $videoGalleries->links() }}
        </div>
    </div>
@endsection

