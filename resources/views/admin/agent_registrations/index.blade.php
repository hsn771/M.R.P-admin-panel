@extends('layouts.admin')

@section('title', 'Agent Registrations')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Agent Registrations</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage agent registrations.</div>
            <a href="{{ route('admin.agent-registrations.create') }}" class="btn btn-primary">Add New</a>
        </div>

        @if (session('success'))
            <div
                style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('success') }}
            </div>
        @endif

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
                <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:0.5rem 0.25rem;">SL</th>
                    <th style="padding:0.5rem 0.25rem;">Full Name</th>
                    <th style="padding:0.5rem 0.25rem;">Mobile No</th>
                    <th style="padding:0.5rem 0.25rem;">Email</th>
                    <th style="padding:0.5rem 0.25rem;">Business Name</th>
                    <th style="padding:0.5rem 0.25rem;">Business Type</th>
                    <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($agentRegistrations as $registration)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:0.5rem 0.25rem;">{{ $loop->iteration }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $registration->full_name }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $registration->mobile_no }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $registration->email }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $registration->business_name }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ ucfirst($registration->business_type) }}</td>
                        <td style="padding:0.5rem 0.25rem; text-align:right;">
                            <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                                <a href="{{ route('admin.agent-registrations.show', $registration) }}"
                                    class="btn btn-outline">Show</a>
                                <a href="{{ route('admin.agent-registrations.edit', $registration) }}"
                                    class="btn btn-outline">Edit</a>
                                <form action="{{ route('admin.agent-registrations.destroy', $registration) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline" style="color:#b91c1c; border-color:#b91c1c;"
                                        onclick="return confirm('Are you sure you want to delete this?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                            No agent registrations found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection