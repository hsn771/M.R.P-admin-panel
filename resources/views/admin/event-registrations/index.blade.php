@extends('layouts.admin')

@section('title', 'Event Registrations')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Event Registrations</h1>
@endsection

@section('content')
    <div class="card" style="padding: 1.5rem;">
        <div style="margin-bottom: 1.5rem;">
            <p style="color: #64748b; font-size: 0.95rem;">Manage event registrations.</p>
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
                        <th style="padding: 0.75rem 1rem; font-weight: 600;">Name</th>
                        <th style="padding: 0.75rem 1rem; font-weight: 600;">Phone</th>
                        <th style="padding: 0.75rem 1rem; font-weight: 600;">Email</th>
                        <th style="padding: 0.75rem 1rem; font-weight: 600;">Gender</th>
                        <th style="padding: 0.75rem 1rem; font-weight: 600;">Post</th>
                        <th style="padding: 0.75rem 1rem; font-weight: 600; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $reg)
                        <tr style="border-bottom: 1px solid #edf2f7;">
                            <td style="padding: 0.75rem 1rem; font-weight: 500;">{{ $reg->name }}</td>
                            <td style="padding: 0.75rem 1rem;">{{ $reg->phone }}</td>
                            <td style="padding: 0.75rem 1rem; color: #64748b;">{{ $reg->email ?? 'N/A' }}</td>
                            <td style="padding: 0.75rem 1rem;">{{ ucfirst($reg->gender) }}</td>
                            <td style="padding: 0.75rem 1rem;">{{ $reg->post }}</td>
                            <td style="padding: 0.75rem 1rem; text-align: right;">
                                <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                    <a href="{{ route('admin.event-registrations.show', $reg) }}" class="btn btn-outline"
                                        style="width: 45px; height: 28px; border-radius: 9999px; border: 1px solid #d1d5db; color: #334155; padding: 0; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-eye" style="font-size: 0.9rem;"></i>
                                    </a>
                                    <form action="{{ route('admin.event-registrations.destroy', $reg) }}" method="POST"
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
                            <td colspan="6" style="padding: 2rem; text-align: center; color: #6b7280;">No registrations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1rem;">
            {{ $registrations->links() }}
        </div>
    </div>
@endsection