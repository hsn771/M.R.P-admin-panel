@extends('layouts.admin')

@section('title', 'Agent Registration Details')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Agent Registration Details</h1>
@endsection

@section('content')
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <div class="muted">Detailed information for the agent registration.</div>
            <div style="display:flex; gap:0.5rem;">
                <a href="{{ route('admin.agent-registrations.index') }}" class="btn btn-outline">Back to List</a>
                <a href="{{ route('admin.agent-registrations.edit', $agentRegistration) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
            <div>
                <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Full Name</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->full_name }}</div>
            </div>
            <div>
                <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Mobile No</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->mobile_no }}</div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
            <div>
                <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Email</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->email }}</div>
            </div>
            <div>
                <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Business Name</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->business_name }}</div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
            <div>
                <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Business Type</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ ucfirst($agentRegistration->business_type) }}</div>
            </div>
            <div>
                <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Time of Business</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->time_of_business }}</div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
            <div>
                <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">District</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->district }}</div>
            </div>
            <div>
                <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">NID No</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->nid_no ?? 'N/A' }}</div>
            </div>
        </div>

        <div style="margin-bottom:1.5rem;">
            <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Address</label>
            <div style="font-size:1rem; color:#111827; line-height:1.5;">{{ $agentRegistration->address }}</div>
        </div>

        <div style="margin-bottom:1.5rem;">
            <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Description(Why do you want to be an agent?)</label>
            <div style="font-size:1rem; color:#111827; line-height:1.5; white-space: pre-wrap;">{{ $agentRegistration->description }}</div>
        </div>

        <div style="border-top:1px solid #f3f4f6; pt-1.5rem; margin-top:1.5rem;">
            <label style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Registration Date</label>
            <div style="font-size:0.85rem; color:#4b5563;">{{ $agentRegistration->created_at->format('d M Y, h:i A') }}</div>
        </div>
    </div>
@endsection
