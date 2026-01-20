@extends('layouts.admin')

@section('title', 'Hero Sections')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Hero Sections</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage hero sections for the frontend.</div>
            <a href="{{ route('admin.hero-sections.create') }}" class="btn btn-primary">New hero section</a>
        </div>

        @if (session('status'))
            <div style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('status') }}
            </div>
        @endif

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
            <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                <th style="padding:0.5rem 0.25rem;">ID</th>
                <th style="padding:0.5rem 0.25rem;">Image</th>
                <th style="padding:0.5rem 0.25rem;">Name</th>
                <th style="padding:0.5rem 0.25rem;">Description</th>
                <th style="padding:0.5rem 0.25rem;">Created</th>
                <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($heroSections as $heroSection)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:0.5rem 0.25rem;">{{ $heroSection->id }}</td>
                    <td style="padding:0.5rem 0.25rem;">
                        @if($heroSection->image)
                            <img src="{{ asset('storage/' . $heroSection->image) }}" alt="Hero section image" 
                                 style="width:80px; height:80px; object-fit:cover; border-radius:0.25rem;">
                        @else
                            <span class="muted">No image</span>
                        @endif
                    </td>
                    <td style="padding:0.5rem 0.25rem;">{{ $heroSection->name }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ Str::limit($heroSection->description, 50) }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $heroSection->created_at->format('M d, Y') }}</td>
                    <td style="padding:0.5rem 0.25rem; text-align:right;">
                        <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                            <a href="{{ route('admin.hero-sections.edit', $heroSection) }}" class="btn btn-outline">Edit</a>
                            <form action="{{ route('admin.hero-sections.destroy', $heroSection) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" 
                                        style="color:#b91c1c; border-color:#b91c1c;"
                                        onclick="return confirm('Are you sure you want to delete this hero section?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                        No hero sections found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:0.75rem;">
            {{ $heroSections->links() }}
        </div>
    </div>
@endsection
