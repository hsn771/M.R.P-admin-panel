@extends('layouts.admin')

@section('title', 'Our Details')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Our Details</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage Our Details.</div>
            {{-- <a href="{{ route('admin.our-details.create') }}" class="btn btn-primary"
                style="background: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem;">
                <i class="fa-solid fa-plus" style="margin-right: 0.5rem;"></i> Add New
            </a> --}}
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
                    <th style="padding:0.5rem 0.25rem;">Address</th>
                    <th style="padding:0.5rem 0.25rem;">Phone</th>
                    <th style="padding:0.5rem 0.25rem;">Email</th>
                    <th style="padding:0.5rem 0.25rem;">Links</th>
                    <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ourDetails as $detail)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:0.5rem 0.25rem;">{{ $detail->our_address }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $detail->our_phone }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $detail->our_email }}</td>
                        <td style="padding:0.5rem 0.25rem; font-size: 1.2rem;">
                            @if($detail->fb_link) <a href="{{ $detail->fb_link }}" target="_blank"
                            style="margin-right: 5px; color: #1877F2;"><i class="fa-brands fa-facebook"></i></a> @endif
                            @if($detail->twitter_link) <a href="{{ $detail->twitter_link }}" target="_blank"
                            style="margin-right: 5px; color: #1DA1F2;"><i class="fa-brands fa-twitter"></i></a> @endif
                            @if($detail->insta_link) <a href="{{ $detail->insta_link }}" target="_blank"
                            style="margin-right: 5px; color: #E1306C;"><i class="fa-brands fa-instagram"></i></a> @endif
                            @if($detail->linkedin_link) <a href="{{ $detail->linkedin_link }}" target="_blank"
                            style="color: #0077B5;"><i class="fa-brands fa-linkedin"></i></a> @endif
                        </td>
                        <td style="padding:0.5rem 0.25rem; text-align:right;">
                            <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                                <a href="{{ route('admin.our-details.show', $detail) }}" class="btn btn-outline"
                                    style="color: #6366f1;">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.our-details.edit', $detail) }}" class="btn btn-outline"
                                    style="color: #2563eb;">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.our-details.destroy', $detail) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline" style="color:#b91c1c;"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:1rem;">No details found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 1rem;">
            {{ $ourDetails->links() }}
        </div>
    </div>
@endsection