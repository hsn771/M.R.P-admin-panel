@extends('layouts.admin')

@section('title', 'Edit Our Details')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit Our Details</h1>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('admin.our-details.update', $ourDetail) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 1rem;">
                <label for="our_address" style="display:block; font-weight:500; margin-bottom:0.5rem;">Address</label>
                <input type="text" name="our_address" id="our_address"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('our_address', $ourDetail->our_address) }}" required>
                @error('our_address') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="our_phone" style="display:block; font-weight:500; margin-bottom:0.5rem;">Phone Numbers</label>
                <input type="text" name="our_phone" id="our_phone"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('our_phone', $ourDetail->our_phone) }}" placeholder="e.g. 01711111111, 01822222222"
                    required>
                <small style="color: #6b7280;">You can enter multiple numbers separated by commas.</small>
                @error('our_phone') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="our_email" style="display:block; font-weight:500; margin-bottom:0.5rem;">Email</label>
                <input type="email" name="our_email" id="our_email"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('our_email', $ourDetail->our_email) }}" required>
                @error('our_email') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="fb_link" style="display:block; font-weight:500; margin-bottom:0.5rem;">Facebook Link</label>
                <input type="url" name="fb_link" id="fb_link"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('fb_link', $ourDetail->fb_link) }}">
                @error('fb_link') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="twitter_link" style="display:block; font-weight:500; margin-bottom:0.5rem;">Twitter Link</label>
                <input type="url" name="twitter_link" id="twitter_link"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('twitter_link', $ourDetail->twitter_link) }}">
                @error('twitter_link') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="insta_link" style="display:block; font-weight:500; margin-bottom:0.5rem;">Instagram Link</label>
                <input type="url" name="insta_link" id="insta_link"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('insta_link', $ourDetail->insta_link) }}">
                @error('insta_link') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="linkedin_link" style="display:block; font-weight:500; margin-bottom:0.5rem;">LinkedIn
                    Link</label>
                <input type="url" name="linkedin_link" id="linkedin_link"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('linkedin_link', $ourDetail->linkedin_link) }}">
                @error('linkedin_link') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="text-align: right;">
                <a href="{{ route('admin.our-details.index') }}" class="btn btn-outline"
                    style="margin-right:0.5rem;">Cancel</a>
                <button type="submit" class="btn btn-primary" style="background:#2563eb; color:white;">Update</button>
            </div>
        </form>
    </div>
@endsection