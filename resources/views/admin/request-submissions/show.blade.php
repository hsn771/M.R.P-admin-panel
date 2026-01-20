@extends('layouts.admin')

@section('title', 'View Request Submission')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">View Request Submission</h1>
@endsection

@section('content')
    <div class="card">
        <div style="margin-bottom:1rem;">
            <a href="{{ route('admin.request-submissions.index') }}" class="btn btn-outline" style="margin-bottom:1rem;">← Back to List</a>
        </div>

        <div style="display:grid; gap:1rem; max-width:800px;">
            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">ID</div>
                <div style="font-size:0.9rem; font-weight:500;">#{{ $requestSubmission->id }}</div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">আপনার নাম (Name)</div>
                <div style="font-size:0.9rem; font-weight:500;">{{ $requestSubmission->name }}</div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">বিষয় (Subject)</div>
                <div style="font-size:0.9rem; font-weight:500;">{{ $requestSubmission->subject }}</div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">ঠিকানা (Address)</div>
                <div style="font-size:0.9rem;">{{ $requestSubmission->address }}</div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                    <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">ইমেইল (Email)</div>
                    <div style="font-size:0.9rem;">{{ $requestSubmission->email ?: '—' }}</div>
                </div>

                <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                    <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">মোবাইল নম্বর (Mobile Number)</div>
                    <div style="font-size:0.9rem; font-weight:500;">{{ $requestSubmission->mobile_number }}</div>
                </div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">ভোটার আইডি কার্ড নাম্বার (Voter ID Card Number)</div>
                <div style="font-size:0.9rem; font-weight:500;">{{ $requestSubmission->voter_id_card_number }}</div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">বিস্তারিত বিবরণ (Detailed Description)</div>
                <div style="font-size:0.9rem; white-space:pre-wrap; line-height:1.6;">{{ $requestSubmission->detailed_description }}</div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Status</div>
                <div style="font-size:0.9rem;">
                    <span style="padding:0.375rem 0.75rem; border-radius:0.375rem; font-size:0.85rem; font-weight:500;
                        @if($requestSubmission->status === 'মীমাংসিত') background:#ecfdf5; color:#166534;
                        @elseif($requestSubmission->status === 'অমীমাংসিত') background:#fef2f2; color:#991b1b;
                        @else background:#eff6ff; color:#1e40af;
                        @endif">
                        {{ $requestSubmission->status ?? 'চলমান' }}
                    </span>
                </div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Submitted At</div>
                <div style="font-size:0.9rem;">{{ $requestSubmission->created_at->format('F d, Y \a\t h:i A') }}</div>
            </div>
        </div>

        <div style="margin-top:1.5rem; display:flex; gap:0.5rem;">
            <a href="{{ route('admin.request-submissions.edit', $requestSubmission) }}" class="btn btn-primary">Edit Status</a>
            <form action="{{ route('admin.request-submissions.destroy', $requestSubmission) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline" 
                        style="color:#b91c1c; border-color:#b91c1c;"
                        onclick="return confirm('Are you sure you want to delete this submission?')">
                    Delete Submission
                </button>
            </form>
        </div>
    </div>
@endsection

