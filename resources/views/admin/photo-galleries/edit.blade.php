@extends('layouts.admin')

@section('title', 'Edit photo')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit photo</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.photo-galleries.update', $photoGallery) }}"
            enctype="multipart/form-data" style="max-width:480px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="title" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title', $photoGallery->title) }}" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('title')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="date" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Date</label>
                <input id="date" name="date" type="date"
                    value="{{ old('date', $photoGallery->date ? $photoGallery->date->format('Y-m-d') : '') }}" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('date')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="images" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Images</label>
                @if($photoGallery->images && count($photoGallery->images) > 0)
                    <div
                        style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom:1rem; background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid #e5e7eb;">
                        @foreach($photoGallery->images as $image)
                            <div style="position: relative; width: 100px;">
                                <img src="{{ asset('storage/' . $image) }}" alt="Current photo"
                                    style="width:100px; height:100px; object-fit:cover; border-radius:0.25rem; border:1px solid #d1d5db;">
                                <div style="margin-top: 0.25rem; display: flex; align-items: center; gap: 0.25rem;">
                                    <input type="checkbox" name="remove_images[]" value="{{ $image }}"
                                        id="remove_{{ $loop->index }}">
                                    <label for="remove_{{ $loop->index }}"
                                        style="font-size: 0.7rem; color: #b91c1c; cursor: pointer;">Remove</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <label for="images" style="display:block; font-size:0.85rem; margin-bottom:0.25rem; color: #4b5563;">Add
                    More Images</label>
                <input id="images" name="images[]" type="file" accept="image/*" multiple
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                <div class="muted" style="margin-top:0.25rem; font-size:0.75rem;">
                    Accepted formats: JPEG, PNG, JPG, GIF, WEBP.
                </div>
                @error('images')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
                @error('images.*')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('admin.photo-galleries.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection