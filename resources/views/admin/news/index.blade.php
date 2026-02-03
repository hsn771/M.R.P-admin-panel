@extends('layouts.admin')

@section('title', 'News')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">News</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage news items.</div>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary"
                style="background: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem;">
                <i class="fa-solid fa-plus" style="margin-right: 0.5rem;"></i>Add News</a>
        </div>

        @if (session('status'))
            <div
                style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('status') }}
            </div>
        @endif

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
                <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:0.5rem 0.25rem;">Image</th>
                    <th style="padding:0.5rem 0.25rem;">ID</th>
                    <th style="padding:0.5rem 0.25rem;">Date</th>
                    <th style="padding:0.5rem 0.25rem;">Type Name</th>
                    <th style="padding:0.5rem 0.25rem;">Title</th>
                    <th style="padding:0.5rem 0.25rem;">Post By</th>
                    <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($news as $item)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:0.5rem 0.25rem;">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="News image"
                                    style="width:50px; height:50px; object-fit:cover; border-radius:0.25rem;">
                            @else
                                <span class="muted">No image</span>
                            @endif
                        </td>
                        <td style="padding:0.5rem 0.25rem;">{{ $item->id }}</td>
                        <td style="padding:0.5rem 0.25rem;">
                            {{ $item->date ? \Carbon\Carbon::parse($item->date)->format('M d, Y') : '-' }}
                        </td>
                        <td style="padding:0.5rem 0.25rem;">{{ $item->type_name }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $item->title }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $item->post_by }}</td>
                        <td style="padding:0.5rem 0.25rem; text-align:right;">
                            <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                                <a href="{{ route('admin.news.show', $item) }}" class="btn btn-outline"
                                    style="padding: 0.25rem 0.5rem;"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-outline"
                                    style="padding: 0.25rem 0.5rem;"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline"
                                        style="color:#b91c1c; border-color:#b91c1c; padding: 0.25rem 0.5rem;"
                                        onclick="return confirm('Are you sure you want to delete this news?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                            No news found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:0.75rem;">
            {{ $news->links() }}
        </div>
    </div>
@endsection