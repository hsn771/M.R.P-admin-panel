@extends('layouts.admin')

@section('title', 'Create permission')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Create permission</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.permissions.store') }}" style="max-width:480px;">
            @csrf

            <div style="margin-bottom:0.75rem;">
                <label for="name" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('name')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection


