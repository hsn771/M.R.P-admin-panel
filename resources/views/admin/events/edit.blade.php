@extends('layouts.admin')

@section('title', 'Edit event')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit event</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.events.update', $event) }}" style="max-width:600px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="title" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title', $event->title) }}" required
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('title')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="date" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Date</label>
                <input id="date" name="date" type="date" value="{{ old('date', $event->date->format('Y-m-d')) }}" required
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('date')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="description" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Description</label>
                <textarea id="description" name="description" rows="5" required
                          style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db; resize:vertical;">{{ old('description', $event->description) }}</textarea>
                @error('description')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection

