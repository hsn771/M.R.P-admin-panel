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
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Full
                    Name</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->full_name }}</div>
            </div>
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Mobile
                    No</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->mobile_no }}</div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Email</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->email }}</div>
            </div>
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Business
                    Name</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->business_name }}</div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Business
                    Type</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">
                    {{ ucfirst($agentRegistration->business_type) }}
                </div>
            </div>
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Time
                    of Business</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->time_of_business }}
                </div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">District</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->district }}</div>
            </div>
            <div>
                <label
                    style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">NID
                    No</label>
                <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $agentRegistration->nid_no ?? 'N/A' }}</div>
            </div>
        </div>

        <div style="margin-bottom:1.5rem;">
            <label
                style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Address</label>
            <div style="font-size:1rem; color:#111827; line-height:1.5;">{{ $agentRegistration->address }}</div>
        </div>

        <div style="margin-bottom:1.5rem;">
            <label
                style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Description(Why
                do you want to be an agent?)</label>
            <div style="font-size:1rem; color:#111827; line-height:1.5; white-space: pre-wrap;">
                {{ $agentRegistration->description }}
            </div>
        </div>

        <div style="margin-bottom:1.5rem;">
            <label
                style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:1rem;">Attachments</label>
            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap:1rem;">

                @if($agentRegistration->photo_up)
                    @foreach(is_array($agentRegistration->photo_up) ? $agentRegistration->photo_up : [$agentRegistration->photo_up] as $photo)
                        <div style="border:1px solid #e5e7eb; padding:0.5rem; border-radius:0.375rem;">
                            <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Photo Upload</div>
                            <img src="{{ route('admin.agent-registrations.view-file', ['filename' => basename($photo)]) }}"
                                style="width:100%; height:100px; object-fit:contain; margin-bottom:0.5rem; border-radius:0.25rem; background:#f3f4f6;">
                            <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($photo)]) }}"
                                target="_blank" class="btn btn-sm btn-outline"
                                style="width:100%; text-align:center; display:block;">View Full</a>
                        </div>
                    @endforeach
                @endif

                @if($agentRegistration->digital_sign)
                    <div style="border:1px solid #e5e7eb; padding:0.5rem; border-radius:0.375rem;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Digital Sign</div>
                        <img src="{{ route('admin.agent-registrations.view-file', ['filename' => basename($agentRegistration->digital_sign)]) }}"
                            style="width:100%; height:100px; object-fit:contain; margin-bottom:0.5rem; border-radius:0.25rem; background:#f3f4f6;">
                        <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($agentRegistration->digital_sign)]) }}"
                            target="_blank" class="btn btn-sm btn-outline"
                            style="width:100%; text-align:center; display:block;">View Full</a>
                    </div>
                @endif

                @if($agentRegistration->considerable_person_sign)
                    <div style="border:1px solid #e5e7eb; padding:0.5rem; border-radius:0.375rem;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Considerable Person Sign</div>
                        <img src="{{ route('admin.agent-registrations.view-file', ['filename' => basename($agentRegistration->considerable_person_sign)]) }}"
                            style="width:100%; height:100px; object-fit:contain; margin-bottom:0.5rem; border-radius:0.25rem; background:#f3f4f6;">
                        <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($agentRegistration->considerable_person_sign)]) }}"
                            target="_blank" class="btn btn-sm btn-outline"
                            style="width:100%; text-align:center; display:block;">View Full</a>
                    </div>
                @endif

                @if($agentRegistration->nid_file)
                    <div style="border:1px solid #e5e7eb; padding:0.5rem; border-radius:0.375rem;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">NID File</div>
                        <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($agentRegistration->nid_file)]) }}"
                            target="_blank" class="btn btn-sm btn-outline"
                            style="width:100%; text-align:center; display:block;">View Document</a>
                    </div>
                @endif

                @if($agentRegistration->husbands_information)
                    <div style="border:1px solid #e5e7eb; padding:0.5rem; border-radius:0.375rem;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Husband's Info</div>
                        <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($agentRegistration->husbands_information)]) }}"
                            target="_blank" class="btn btn-sm btn-outline"
                            style="width:100%; text-align:center; display:block;">View Document</a>
                    </div>
                @endif

                @if($agentRegistration->bank_check)
                    <div style="border:1px solid #e5e7eb; padding:0.5rem; border-radius:0.375rem;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Bank Check</div>
                        <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($agentRegistration->bank_check)]) }}"
                            target="_blank" class="btn btn-sm btn-outline"
                            style="width:100%; text-align:center; display:block;">View Document</a>
                    </div>
                @endif

                @if($agentRegistration->birth_certificate)
                    <div style="border:1px solid #e5e7eb; padding:0.5rem; border-radius:0.375rem;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Birth Certificate</div>
                        <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($agentRegistration->birth_certificate)]) }}"
                            target="_blank" class="btn btn-sm btn-outline"
                            style="width:100%; text-align:center; display:block;">View
                            Document</a>
                    </div>
                @endif

                @if($agentRegistration->chairman_certificate)
                    <div style="border:1px solid #e5e7eb; padding:0.5rem; border-radius:0.375rem;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Chairman Certificate</div>
                        <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($agentRegistration->chairman_certificate)]) }}"
                            target="_blank" class="btn btn-sm btn-outline"
                            style="width:100%; text-align:center; display:block;">View
                            Document</a>
                    </div>
                @endif

                @if($agentRegistration->trade_license)
                    <div style="border:1px solid #e5e7eb; padding:0.5rem; border-radius:0.375rem;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Trade License</div>
                        <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($agentRegistration->trade_license)]) }}"
                            target="_blank" class="btn btn-sm btn-outline"
                            style="width:100%; text-align:center; display:block;">View
                            Document</a>
                    </div>
                @endif

            </div>
        </div>
        <label
            style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Registration
            Date</label>
        <div style="font-size:0.85rem; color:#4b5563;">{{ $agentRegistration->created_at->format('d M Y, h:i A') }}</div>
    </div>
    </div>
@endsection