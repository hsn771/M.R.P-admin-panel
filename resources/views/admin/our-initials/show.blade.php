@extends('layouts.admin')

@section('title', 'Our Initial Details')

@section('header')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 style="font-size: 1.1rem; font-weight: 600;">Our Initial Details</h1>
        <a href="{{ route('admin.our-initials.index') }}" class="btn btn-outline">Back to List</a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div style="display: grid; gap: 1rem; max-width: 800px;">

            @if($ourInitial->image)
                <div>
                    <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Image</label>
                    <img src="{{ asset('storage/' . $ourInitial->image) }}" alt="Image"
                        style="max-width: 100%; max-height: 400px; border-radius: 0.5rem;">
                </div>
            @endif

            <div>
                <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Title</label>
                <div style="font-size: 1.1rem; font-weight: 500;">{{ $ourInitial->title }}</div>
            </div>

            @if($ourInitial->description)
                <div>
                    <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Description</label>
                    <div style="font-size: 1rem; white-space: pre-wrap; line-height: 1.5;">{{ $ourInitial->description }}</div>
                </div>
            @endif

            <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                <div style="font-size: 0.8rem; color: #9ca3af;">
                    Created at: {{ $ourInitial->created_at->format('M d, Y H:i') }}
                </div>
            </div>
        </div>
    </div>
@endsection