@extends('layouts.admin')

@section('title', 'Our Milestone Details')

@section('header')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 style="font-size: 1.1rem; font-weight: 600;">Our Milestone Details</h1>
        <a href="{{ route('admin.our-milestones.index') }}" class="btn btn-outline">Back to List</a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div style="display: grid; gap: 1rem; max-width: 800px;">

            <div>
                <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Year</label>
                <div style="font-size: 1.1rem; font-weight: 500;">{{ $ourMilestone->year }}</div>
            </div>

            @if($ourMilestone->title)
                <div>
                    <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Title</label>
                    <div style="font-size: 1.1rem; font-weight: 500;">{{ $ourMilestone->title }}</div>
                </div>
            @endif

            @if($ourMilestone->description)
                <div>
                    <label style="display:block; font-size:0.85rem; color: #6b7280; margin-bottom:0.25rem;">Description</label>
                    <div style="font-size: 1rem; white-space: pre-wrap; line-height: 1.5;">{{ $ourMilestone->description }}
                    </div>
                </div>
            @endif

            <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                <div style="font-size: 0.8rem; color: #9ca3af;">
                    Created at: {{ $ourMilestone->created_at->format('M d, Y H:i') }}
                </div>
            </div>
        </div>
    </div>
@endsection