@extends('layouts.admin')

@section('title', 'Share Investments')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Share Investment Applications</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:0.5rem;">
            <div class="muted">শেয়ার বিনিয়োগ আবেদন ফরম থেকে আসা আবেদনসমূহ।</div>
            <form action="{{ route('admin.share-investments.index') }}" method="GET"
                style="display:flex; gap:0.5rem; align-items:center;">
                <input type="text" name="search" placeholder="Application No / Name / Phone" value="{{ request('search') }}"
                    style="padding:0.4rem 0.75rem; border:1px solid #e5e7eb; border-radius:0.375rem; font-size:0.875rem;">
                <button type="submit" class="btn btn-primary"
                    style="background: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; font-size: 0.875rem;">
                    <i class="fa-solid fa-magnifying-glass" style="margin-right: 0.5rem;"></i> Search
                </button>
                @if (request('search'))
                    <a href="{{ route('admin.share-investments.index') }}" class="btn btn-outline"
                        style="background: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem;">
                        <i class="fa-solid fa-rotate-left" style="margin-right: 0.5rem;"></i> Clear
                    </a>
                @endif
            </form>
        </div>

        @if (session('success'))
            <div
                style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
                <thead>
                    <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                        <th style="padding:0.5rem 0.25rem;">Application No</th>
                        <th style="padding:0.5rem 0.25rem;">Photo</th>
                        <th style="padding:0.5rem 0.25rem;">Customer</th>
                        <th style="padding:0.5rem 0.25rem;">Phone</th>
                        <th style="padding:0.5rem 0.25rem;">Category</th>
                        <th style="padding:0.5rem 0.25rem;">Amount (৳)</th>
                        <th style="padding:0.5rem 0.25rem;">Date</th>
                        <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($shareInvestments as $item)
                        <tr style="border-bottom:1px solid #f3f4f6;">
                            <td style="padding:0.5rem 0.25rem;">{{ $item->application_no }}</td>
                            <td style="padding:0.5rem 0.25rem;">
                                @if ($item->customer_photo)
                                    <img src="{{ route('admin.share-investments.view-file', ['filename' => basename($item->customer_photo)]) }}"
                                        alt="Photo" style="width:40px; height:40px; object-fit:cover; border-radius:0.25rem;">
                                @else
                                    <span class="muted">—</span>
                                @endif
                            </td>
                            <td style="padding:0.5rem 0.25rem;">{{ $item->customer_name }}</td>
                            <td style="padding:0.5rem 0.25rem;">{{ $item->customer_phone }}</td>
                            <td style="padding:0.5rem 0.25rem;">{{ $item->category_label }}</td>
                            <td style="padding:0.5rem 0.25rem;">{{ number_format($item->investment_amount, 2) }}</td>
                            <td style="padding:0.5rem 0.25rem;">{{ $item->created_at->format('d M Y') }}</td>
                            <td style="padding:0.5rem 0.25rem; text-align:right;">
                                <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                                    <a href="{{ route('admin.share-investments.show', $item) }}" class="btn btn-outline" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.share-investments.destroy', $item) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline" title="Delete"
                                            style="color:#b91c1c; border-color:#b91c1c;"
                                            onclick="return confirm('Are you sure you want to delete this?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                                No share investment applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:1rem;">
            {{ $shareInvestments->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
