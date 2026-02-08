@extends('layouts.admin')

@section('title', 'View Home Item')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">View Home Item</h1>
@endsection

@section('content')
    <div class="card">
        <div style="margin-bottom:1rem;">
            <a href="{{ route('admin.homes.index') }}" class="btn btn-outline" style="margin-right:0.5rem;">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <a href="{{ route('admin.homes.edit', $home) }}" class="btn btn-primary">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 2fr; gap:2rem;">
            <div>
                @if($home->image)
                    <img src="{{ asset('storage/' . $home->image) }}" alt="Image"
                        style="width:100%; max-width:300px; border-radius:0.5rem; object-fit:cover;">
                @else
                    <div
                        style="width:100%; max-width:300px; height:200px; background:#f3f4f6; display:flex; align-items:center; justify-content:center; border-radius:0.5rem;">
                        <span class="muted">No Image</span>
                    </div>
                @endif
            </div>

            <div>
                <h2 style="font-size:1.5rem; font-weight:600; margin-bottom:0.5rem;">{{ $home->title }}</h2>

                <div style="margin-bottom:1rem; color:#4b5563; line-height:1.6;">
                    {!! nl2br(e($home->description)) !!}
                </div>

                @if($home->points && is_array($home->points) && count($home->points) > 0)
                    {{-- <h3 style="font-size:1.1rem; font-weight:600; margin-bottom:0.5rem;">Points</h3> --}}
                    <ul style="list-style-type: disc; padding-left: 1.5rem; color:#4b5563;">
                        @foreach($home->points as $point)
                            <li style="margin-bottom:0.25rem;">{{ $point }}</li>
                        @endforeach
                    </ul>
                @endif

                {{-- <div style="margin-top:2rem; font-size:0.85rem; color:#6b7280;">
                    <div>Created: {{ $home->created_at->format('M d, Y H:i') }}</div>
                    <div>Updated: {{ $home->updated_at->format('M d, Y H:i') }}</div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection