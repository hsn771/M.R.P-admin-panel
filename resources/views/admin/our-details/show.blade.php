@extends('layouts.admin')

@section('title', 'Our Details')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Our Details</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1rem; font-weight: 600; color: #374151;">Details Overview</h2>
            <div>
                <a href="{{ route('admin.our-details.index') }}" class="btn btn-outline" style="margin-right: 0.5rem;">
                    <i class="fas fa-arrow-left" style="margin-right: 0.25rem;"></i> Back to List
                </a>
                <a href="{{ route('admin.our-details.edit', $ourDetail) }}" class="btn btn-primary"
                    style="background:#2563eb; color:white;">
                    <i class="fas fa-edit" style="margin-right: 0.25rem;"></i> Edit Details
                </a>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
            <div>
                <label
                    style="display:block; font-weight:600; color: #4b5563; font-size: 0.85rem; margin-bottom:0.25rem;">Address</label>
                <p style="color: #111827; font-size: 0.95rem;">{{ $ourDetail->our_address }}</p>
            </div>

            <div>
                <label
                    style="display:block; font-weight:600; color: #4b5563; font-size: 0.85rem; margin-bottom:0.25rem;">Phone
                    Numbers</label>
                <p style="color: #111827; font-size: 0.95rem;">{{ $ourDetail->our_phone }}</p>
            </div>

            <div>
                <label
                    style="display:block; font-weight:600; color: #4b5563; font-size: 0.85rem; margin-bottom:0.25rem;">Email
                    Address</label>
                <p style="color: #111827; font-size: 0.95rem;">{{ $ourDetail->our_email }}</p>
            </div>

            <div>
                <label
                    style="display:block; font-weight:600; color: #4b5563; font-size: 0.85rem; margin-bottom:0.25rem;">Facebook
                    Link</label>
                @if($ourDetail->fb_link)
                    <a href="{{ $ourDetail->fb_link }}" target="_blank"
                        style="color: #2563eb; text-decoration: none; font-size: 0.95rem;">
                        <i class="fab fa-facebook" style="margin-right: 0.25rem;"></i> {{ $ourDetail->fb_link }}
                    </a>
                @else
                    <p style="color: #9ca3af; font-size: 0.95rem; font-style: italic;">Not provided</p>
                @endif
            </div>

            <div>
                <label
                    style="display:block; font-weight:600; color: #4b5563; font-size: 0.85rem; margin-bottom:0.25rem;">Twitter
                    Link</label>
                @if($ourDetail->twitter_link)
                    <a href="{{ $ourDetail->twitter_link }}" target="_blank"
                        style="color: #2563eb; text-decoration: none; font-size: 0.95rem;">
                        <i class="fab fa-twitter" style="margin-right: 0.25rem;"></i> {{ $ourDetail->twitter_link }}
                    </a>
                @else
                    <p style="color: #9ca3af; font-size: 0.95rem; font-style: italic;">Not provided</p>
                @endif
            </div>

            <div>
                <label
                    style="display:block; font-weight:600; color: #4b5563; font-size: 0.85rem; margin-bottom:0.25rem;">Instagram
                    Link</label>
                @if($ourDetail->insta_link)
                    <a href="{{ $ourDetail->insta_link }}" target="_blank"
                        style="color: #2563eb; text-decoration: none; font-size: 0.95rem;">
                        <i class="fab fa-instagram" style="margin-right: 0.25rem;"></i> {{ $ourDetail->insta_link }}
                    </a>
                @else
                    <p style="color: #9ca3af; font-size: 0.95rem; font-style: italic;">Not provided</p>
                @endif
            </div>

            <div>
                <label
                    style="display:block; font-weight:600; color: #4b5563; font-size: 0.85rem; margin-bottom:0.25rem;">LinkedIn
                    Link</label>
                @if($ourDetail->linkedin_link)
                    <a href="{{ $ourDetail->linkedin_link }}" target="_blank"
                        style="color: #2563eb; text-decoration: none; font-size: 0.95rem;">
                        <i class="fab fa-linkedin" style="margin-right: 0.25rem;"></i> {{ $ourDetail->linkedin_link }}
                    </a>
                @else
                    <p style="color: #9ca3af; font-size: 0.95rem; font-style: italic;">Not provided</p>
                @endif
            </div>
        </div>
    </div>
@endsection