@extends('layouts.admin')

@section('title', 'Registration Details')

@section('header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="font-size: 1.1rem; font-weight: 600;">Registration Details</h1>
        <a href="{{ route('admin.event-registrations.index') }}" class="btn btn-outline btn-sm">Back to List</a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem;">
            <div>
                <label
                    style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 0.25rem;">Full
                    Name</label>
                <p style="font-size: 1rem; color: #111827; font-weight: 500;">{{ $registration->name }}</p>
            </div>

            <div>
                <label
                    style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 0.25rem;">Phone
                    Number</label>
                <p style="font-size: 1rem; color: #111827; font-weight: 500;">{{ $registration->phone }}</p>
            </div>

            <div>
                <label
                    style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 0.25rem;">Email
                    Address</label>
                <p style="font-size: 1rem; color: #111827; font-weight: 500;">{{ $registration->email ?? 'Not Provided' }}
                </p>
            </div>

            <div>
                <label
                    style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 0.25rem;">Gender</label>
                <p style="font-size: 1rem; color: #111827; font-weight: 500;">{{ ucfirst($registration->gender) }}</p>
            </div>

            <div>
                <label
                    style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 0.25rem;">Joining
                    As (Post)</label>
                <p style="font-size: 1rem; color: #111827; font-weight: 500;">{{ $registration->post }}</p>
            </div>

            <div style="grid-column: span 2;">
                <label
                    style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 0.25rem;">Additional
                    Information</label>
                <div
                    style="padding: 1rem; background-color: #f9fafb; border-radius: 0.5rem; color: #374151; line-height: 1.5;">
                    {{ $registration->additional_info ?: 'No additional information provided.' }}
                </div>
            </div>

            <div>
                <label
                    style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 0.25rem;">Registration
                    Date</label>
                <p style="font-size: 0.9rem; color: #6b7280;">{{ $registration->created_at->format('F d, Y h:i A') }}</p>
            </div>
        </div>

        <div
            style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #edf2f7; display: flex; justify-content: flex-end;">
            <form action="{{ route('admin.event-registrations.destroy', $registration) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this registration?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary"
                    style="background-color: #dc2626; border-color: #dc2626;">Delete Registration</button>
            </form>
        </div>
    </div>
@endsection