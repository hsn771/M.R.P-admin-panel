@extends('layouts.admin')

@section('title', 'Edit Our Initial')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit Our Initial</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.our-initials.update', $ourInitial) }}" enctype="multipart/form-data"
            style="max-width:600px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="image" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Image</label>
                @if($ourInitial->image)
                    <div style="margin-bottom: 0.5rem;">
                        <img src="{{ asset('storage/' . $ourInitial->image) }}" alt="Current Image"
                            style="width: 100px; height: auto; border-radius: 0.25rem;">
                    </div>
                @endif
                <input id="image" name="image" type="file" accept="image/*"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                <div class="muted" style="margin-top:0.25rem; font-size:0.75rem;">Leave empty to keep current image.</div>
                @error('image')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="title" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title', $ourInitial->title) }}" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('title')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="description"
                    style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Description</label>
                <textarea id="description" name="description" rows="5"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">{{ old('description', $ourInitial->description) }}</textarea>
                @error('description')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.our-initials.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection