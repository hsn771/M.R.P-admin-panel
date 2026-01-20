@extends('layouts.admin')

@section('title', 'Edit hero section')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit hero section</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.hero-sections.update', $heroSection) }}" enctype="multipart/form-data" style="max-width:600px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="name" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $heroSection->name) }}" required
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('name')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="image" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Image</label>
                @if($heroSection->image)
                    <div style="margin-bottom:0.5rem;">
                        <img src="{{ asset('storage/' . $heroSection->image) }}" alt="Current hero section image" 
                             style="width:200px; height:200px; object-fit:cover; border-radius:0.25rem; border:1px solid #d1d5db;">
                    </div>
                @endif
                <input id="image" name="image" type="file" accept="image/*"
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                <div class="muted" style="margin-top:0.25rem; font-size:0.75rem;">
                    Accepted formats: JPEG, PNG, JPG, GIF, WEBP. Max size: 2MB. Leave blank to keep current image.
                </div>
                @error('image')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="description" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Description</label>
                <textarea id="description" name="description" rows="8" required
                          style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db; resize:vertical;">{{ old('description', $heroSection->description) }}</textarea>
                @error('description')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('admin.hero-sections.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection
