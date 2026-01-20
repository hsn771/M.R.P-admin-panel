@extends('layouts.admin')

@section('title', 'Blogs')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Blogs</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage blog posts and their content.</div>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">New blog</a>
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
                <th style="padding:0.5rem 0.25rem;">Title</th>
                <th style="padding:0.5rem 0.25rem;">Description</th>
                <th style="padding:0.5rem 0.25rem;">Created</th>
                <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($blogs as $blog)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:0.5rem 0.25rem;">{{ $blog->id }}</td>
                    <td style="padding:0.5rem 0.25rem;">
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog image" 
                                 style="width:80px; height:80px; object-fit:cover; border-radius:0.25rem;">
                        @else
                            <span class="muted">No image</span>
                        @endif
                    </td>
                    <td style="padding:0.5rem 0.25rem;">{{ $blog->title }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ Str::limit($blog->description, 50) }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $blog->created_at->format('M d, Y') }}</td>
                    <td style="padding:0.5rem 0.25rem; text-align:right;">
                        <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-outline">Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" 
                                        style="color:#b91c1c; border-color:#b91c1c;"
                                        onclick="return confirm('Are you sure you want to delete this blog?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                        No blogs found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:0.75rem;">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection
