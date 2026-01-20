@extends('layouts.admin')

@section('title', 'Contact Message Details')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Contact Message Details</h1>
@endsection

@section('content')
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <div class="muted">Detailed information for the contact message.</div>
            <div style="display:flex; gap:0.5rem;">
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline">Back to List</a>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Name</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $contact->name }}</div>
            </div>
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Phone</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $contact->phone }}</div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Email</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $contact->email }}</div>
            </div>
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Subject</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $contact->subject }}</div>
            </div>
        </div>

        <div style="margin-bottom:1.5rem;">
            <label
                style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Message</label>
            <div style="font-size:1rem; color:#111827; line-height:1.5; white-space: pre-wrap;">{{ $contact->message }}
            </div>
        </div>

        <div style="border-top:1px solid #f3f4f6; pt-1.5rem; margin-top:1.5rem;">
            <label
                style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Submitted
                Date</label>
            <div style="font-size:0.85rem; color:#4b5563;">{{ $contact->created_at->format('d M Y, h:i A') }}</div>
        </div>
    </div>
@endsection