@extends('layouts.admin')

@section('title', 'Add Our Milestone')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Add Our Milestone</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.our-milestones.store') }}" style="max-width:600px;">
            @csrf

            <div style="margin-bottom:0.75rem;">
                <label for="year" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Year</label>
                <input id="year" name="year" type="text" value="{{ old('year') }}" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    placeholder="e.g. 2020 or 2020-2021">
                @error('year')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="title" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('title')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="description"
                    style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Description</label>
                <textarea id="description" name="description" rows="5"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">{{ old('description') }}</textarea>
                @error('description')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('admin.our-milestones.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection