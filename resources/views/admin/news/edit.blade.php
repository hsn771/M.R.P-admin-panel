@extends('layouts.admin')

@section('title', 'Edit News')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit News</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data"
            style="max-width:600px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="image" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Image</label>
                @if($news->image)
                    <div style="margin-bottom: 0.5rem;">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="Current Image"
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
                <label for="date" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Date</label>
                <input id="date" name="date" type="date"
                    value="{{ old('date', $news->date ? \Carbon\Carbon::parse($news->date)->format('Y-m-d') : '') }}"
                    required style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('date')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="type_name" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Type Name</label>
                <input id="type_name" name="type_name" type="text" value="{{ old('type_name', $news->type_name) }}" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('type_name')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="title" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title', $news->title) }}" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('title')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="post_by" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Post By</label>
                <input id="post_by" name="post_by" type="text" value="{{ old('post_by', $news->post_by) }}"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('post_by')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="description"
                    style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Description</label>
                <textarea id="description" name="description" rows="5"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">{{ old('description', $news->description) }}</textarea>
                @error('description')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Update News</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection