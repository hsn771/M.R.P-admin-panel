@extends('layouts.admin')

@section('title', 'Events')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Events</h1>
@endsection

@section('content')
    <div class="card" style="padding: 1.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <p style="color: #64748b; font-size: 0.95rem;">Manage events.</p>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary"
                style="padding: 0.5rem 1rem; border-radius: 0.375rem; display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; text-decoration: none; background-color: #2563eb; color: white;">
                <i class="fa-solid fa-plus"></i>
                Add New
            </a>
        </div>

        @if (session('status'))
            <div
                style="background-color: #d1fae5; color: #065f46; padding: 0.75rem 1rem; border-radius: 0.4rem; margin-bottom: 1rem; font-size: 0.85rem;">
                {{ session('status') }}
            </div>
        @endif

        <div style="padding: 0; overflow: hidden; border: 1px solid #edf2f7; border-radius: 0.5rem;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.85rem;">
                <thead>
                    <tr style="background-color: #f9fafb; border-bottom: 1px solid #edf2f7;">
                        <th style="padding: 0.75rem 1rem; font-weight: 600;">Image</th>
                        <th style="padding: 0.75rem 1rem; font-weight: 600;">Type</th>
                        <th style="padding: 0.75rem 1rem; font-weight: 600;">Title</th>
                        <th style="padding: 0.75rem 1rem; font-weight: 600;">Date</th>
                        <th style="padding: 0.75rem 1rem; font-weight: 600;">Time</th>
                        <th style="padding: 0.75rem 1rem; font-weight: 600; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr style="border-bottom: 1px solid #edf2f7;">
                            <td style="padding: 0.75rem 1rem;">
                                @if($event->image)
                                    <img src="{{ asset($event->image) }}" alt="Event"
                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 0.3rem;">
                                @else
                                    <div
                                        style="width: 50px; height: 50px; background: #eee; border-radius: 0.3rem; display: flex; align-items: center; justify-content: center; color: #aaa;">
                                        No image</div>
                                @endif
                            </td>
                            <td style="padding: 0.75rem 1rem; color: #666;">{{ $event->type_name ?? 'N/A' }}</td>
                            <td style="padding: 0.75rem 1rem; font-weight: 500;">{{ $event->title }}</td>
                            <td style="padding: 0.75rem 1rem;">{{ $event->date->format('M d, Y') }}</td>
                            <td style="padding: 0.75rem 1rem;">{{ $event->time ?? 'N/A' }}</td>
                            <td style="padding: 0.75rem 1rem; text-align: right;">
                                <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                    <a href="{{ route('admin.events.show', $event) }}" class="btn btn-outline"
                                        style="width: 45px; height: 28px; border-radius: 9999px; border: 1px solid #d1d5db; color: #334155; padding: 0; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-eye" style="font-size: 0.9rem;"></i>
                                    </a>
                                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-outline"
                                        style="width: 45px; height: 28px; border-radius: 9999px; border: 1px solid #d1d5db; color: #334155; padding: 0; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-pen-to-square" style="font-size: 0.9rem;"></i>
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline"
                                            style="width: 45px; height: 28px; border-radius: 9999px; border: 1px solid #dc2626; color: #dc2626; padding: 0; display: flex; align-items: center; justify-content: center; cursor: pointer; background: transparent;">
                                            <i class="fa-solid fa-trash" style="font-size: 0.9rem;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 2rem; text-align: center; color: #6b7280;">No events found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($events->hasPages())
            <div style="margin-top: 1rem;">
                {{ $events->links() }}
            </div>
        @endif
    </div>
@endsection