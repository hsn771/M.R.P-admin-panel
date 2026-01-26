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

            @php
                $attachmentFields = [
                    ['label' => 'Photo / PDF', 'field' => 'photo_up', 'multiple' => true],
                    ['label' => 'Digital Sign', 'field' => 'digital_sign', 'multiple' => false],
                    ['label' => 'Considerable Person Sign', 'field' => 'considerable_person_sign', 'multiple' => false],
                    ['label' => 'NID File', 'field' => 'nid_file', 'multiple' => false],
                    ['label' => 'Husband\'s Info', 'field' => 'husbands_information', 'multiple' => false],
                    ['label' => 'Bank Check', 'field' => 'bank_check', 'multiple' => false],
                    ['label' => 'Birth Certificate', 'field' => 'birth_certificate', 'multiple' => false],
                    ['label' => 'Chairman Certificate', 'field' => 'chairman_certificate', 'multiple' => false],
                    ['label' => 'Trade License', 'field' => 'trade_license', 'multiple' => false],
                ];
            @endphp

            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap:1rem;">
                @foreach($attachmentFields as $item)
                    @php
                        $files = $item['multiple']
                            ? ($agentRegistration->{$item['field']} ?? [])
                            : ($agentRegistration->{$item['field']} ? [$agentRegistration->{$item['field']}] : []);
                    @endphp

                    @foreach($files as $file)
                        @php
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                            $isPdf = $ext === 'pdf';
                        @endphp
                        <div
                            style="border:1px solid #e5e7eb; padding:0.75rem; border-radius:0.5rem; background:#fff; display:flex; flex-direction:column; justify-content:space-between;">
                            <div>
                                <div
                                    style="font-size:0.75rem; color:#6b7280; font-weight:600; margin-bottom:0.5rem; text-transform:uppercase;">
                                    {{ $item['label'] }}</div>

                                @if($isImage)
                                    <div
                                        style="width:100%; height:120px; background:#f9fafb; border-radius:0.375rem; overflow:hidden; border:1px solid #f3f4f6; margin-bottom:0.75rem; display:flex; align-items:center; justify-content:center;">
                                        <img src="{{ route('admin.agent-registrations.view-file', ['filename' => basename($file)]) }}"
                                            style="max-width:100%; max-height:100%; object-fit:contain;">
                                    </div>
                                @elseif($isPdf)
                                    <div
                                        style="width:100%; height:120px; background:#fff1f2; border-radius:0.375rem; border:1px solid #fecaca; margin-bottom:0.75rem; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#dc2626; gap:0.5rem;">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:32px; height:32px;" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span style="font-size:0.75rem; font-weight:700;">PDF DOCUMENT</span>
                                    </div>
                                @else
                                    <div
                                        style="width:100%; height:120px; background:#f9fafb; border-radius:0.375rem; border:1px solid #f3f4f6; margin-bottom:0.75rem; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#6b7280; gap:0.5rem;">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:32px; height:32px;" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span style="font-size:0.75rem; font-weight:500;">{{ strtoupper($ext) }} DOCUMENT</span>
                                    </div>
                                @endif
                            </div>

                            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:0.5rem; margin-top: auto;">
                                <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($file)]) }}"
                                    target="_blank" class="btn btn-sm btn-outline"
                                    style="width:100%; text-align:center; padding: 0.4rem 0; font-size: 0.75rem;">View</a>
                                <a href="{{ route('admin.agent-registrations.view-file', ['filename' => basename($file), 'download' => 1]) }}"
                                    class="btn btn-sm btn-primary"
                                    style="width:100%; text-align:center; padding: 0.4rem 0; font-size: 0.75rem;">Download</a>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        <label
            style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Registration
            Date</label>
        <div style="font-size:0.85rem; color:#4b5563;">{{ $agentRegistration->created_at->format('d M Y, h:i A') }}</div>
    </div>
    </div>
@endsection