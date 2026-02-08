@extends('layouts.admin')

@section('title', 'Newsletter Subscribers')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Newsletter Subscribers</h1>
@endsection

@section('content')
    <div class="card">
        <div style="margin-bottom:1rem;">
            <div class="muted">Manage people who subscribed to your newsletter.</div>
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
                    <th style="padding:0.5rem 0.25rem;">#</th>
                    <th style="padding:0.5rem 0.25rem;">Email</th>
                    <th style="padding:0.5rem 0.25rem;">Subscribed At</th>
                    <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subscribers as $index => $subscriber)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:0.5rem 0.25rem;">{{ $subscribers->firstItem() + $index }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $subscriber->email }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $subscriber->created_at->format('M d, Y H:i') }}</td>
                        <td style="padding:0.5rem 0.25rem; text-align:right;">
                            <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline"
                                    style="color:#b91c1c; border-color:#b91c1c; padding: 0.25rem 0.5rem;"
                                    onclick="return confirm('Are you sure you want to remove this subscriber?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                            No subscribers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:0.75rem;">
            {{ $subscribers->links() }}
        </div>
    </div>
@endsection