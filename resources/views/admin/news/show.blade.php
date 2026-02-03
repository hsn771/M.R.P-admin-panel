@extends('layouts.admin')

@section('title', 'News Details')

@section('header')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 style="font-size: 1.1rem; font-weight: 600;">News Details</h1>
        <a href="{{ route('admin.news.index') }}" class="btn btn-outline">Back to List</a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div style="display: grid; gap: 1rem; max-width: 800px;">

            @if($news->image)
                <div>
                    <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Image</label>
                    <img src="{{ asset('storage/' . $news->image) }}" alt="News Image"
                        style="max-width: 100%; max-height: 400px; border-radius: 0.5rem;">
                </div>
            @endif

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Date</label>
                    <div style="font-size: 1rem;">
                        {{ $news->date ? \Carbon\Carbon::parse($news->date)->format('F d, Y') : '-' }}</div>
                </div>

                <div>
                    <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Type
                        Name</label>
                    <div style="font-size: 1rem;">{{ $news->type_name }}</div>
                </div>
            </div>

            <div>
                <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Title</label>
                <div style="font-size: 1.1rem; font-weight: 500;">{{ $news->title }}</div>
            </div>

            @if($news->post_by)
                <div>
                    <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Post By</label>
                    <div style="font-size: 1rem;">{{ $news->post_by }}</div>
                </div>
            @endif

            @if($news->description)
                <div>
                    <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Description</label>
                    <div style="font-size: 1rem; white-space: pre-wrap; line-height: 1.5;">{{ $news->description }}</div>
                </div>
            @endif

            <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                <div style="font-size: 0.8rem; color: #9ca3af;">
                    Created at: {{ $news->created_at->format('M d, Y H:i') }}
                </div>
            </div>
        </div>
    </div>
@endsection