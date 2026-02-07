@extends('layouts.admin')

@section('title', 'Edit Our Mission')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit Our Mission</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.our-missions.update', $ourMission) }}" enctype="multipart/form-data"
            style="max-width:800px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="image" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Image</label>
                @if($ourMission->image)
                    <div style="margin-bottom:0.5rem;">
                        <img src="{{ asset('storage/' . $ourMission->image) }}" alt="Current Image"
                            style="width:100px; height:100px; object-fit:cover; border-radius:0.25rem;">
                    </div>
                @endif
                <input id="image" name="image" type="file" accept="image/*"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('image')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="title" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title', $ourMission->title) }}" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('title')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="description"
                    style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Description</label>
                <textarea id="description" name="description" rows="5"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">{{ old('description', $ourMission->description) }}</textarea>
                @error('description')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Points</label>
                <div id="points-container">
                    @php
                        $points = old('points', $ourMission->points ?? []);
                    @endphp

                    @if(!empty($points))
                        @foreach($points as $index => $point)
                            <div class="point-item" style="display:flex; gap:0.5rem; margin-bottom:0.5rem;">
                                <input name="points[]" type="text" value="{{ $point }}"
                                    style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                                    placeholder="Enter point">
                                <button type="button" onclick="removePoint(this)"
                                    style="padding:0.45rem 0.6rem; border:1px solid #b91c1c; background:#fee2e2; color:#b91c1c; border-radius:0.4rem; cursor:pointer;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    @else
                        {{-- Initial empty point input --}}
                        <div class="point-item" style="display:flex; gap:0.5rem; margin-bottom:0.5rem;">
                            <input name="points[]" type="text"
                                style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                                placeholder="Enter point">
                            <button type="button" onclick="removePoint(this)"
                                style="padding:0.45rem 0.6rem; border:1px solid #b91c1c; background:#fee2e2; color:#b91c1c; border-radius:0.4rem; cursor:pointer;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <button type="button" onclick="addPoint()" class="btn btn-secondary"
                    style="margin-top:0.5rem; padding:0.4rem 0.8rem; font-size:0.85rem;">
                    <i class="fa-solid fa-plus"></i> Add Point
                </button>
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.our-missions.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        function addPoint() {
            const container = document.getElementById('points-container');
            const div = document.createElement('div');
            div.className = 'point-item';
            div.style.cssText = 'display:flex; gap:0.5rem; margin-bottom:0.5rem;';
            div.innerHTML = `
                    <input name="points[]" type="text"
                        style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;" placeholder="Enter point">
                    <button type="button" onclick="removePoint(this)" 
                        style="padding:0.45rem 0.6rem; border:1px solid #b91c1c; background:#fee2e2; color:#b91c1c; border-radius:0.4rem; cursor:pointer;">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                `;
            container.appendChild(div);
        }

        function removePoint(button) {
            button.parentElement.remove();
        }
    </script>
@endsection