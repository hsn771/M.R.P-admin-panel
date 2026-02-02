@extends('layouts.admin')

@section('title', 'Add photo to gallery')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Add photo to gallery</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.photo-galleries.store') }}" enctype="multipart/form-data"
            style="max-width:480px;">
            @csrf

            <div style="margin-bottom:0.75rem;">
                <label for="title" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('title')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="date" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Date</label>
                <input id="date" name="date" type="date" value="{{ old('date', date('Y-m-d')) }}" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('date')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="images" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Images
                    (Multiple)</label>
                <input id="images" name="images[]" type="file" accept="image/*" multiple required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                <div class="muted" style="margin-top:0.25rem; font-size:0.75rem;">
                    Accepted formats: JPEG, PNG, JPG, GIF, WEBP. Max size: 2MB per image.
                </div>
                @error('images')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
                @error('images.*')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Create Gallery</button>
                <a href="{{ route('admin.photo-galleries.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection