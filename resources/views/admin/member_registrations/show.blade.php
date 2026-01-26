@extends('layouts.admin')

@section('title', 'Member Registration Details')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Member Registration Details</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <h3 style="margin:0;">Details</h3>
            <a href="{{ route('admin.member-registrations.index') }}" class="btn btn-outline">Back to List</a>
        </div>

        {{-- 1st Section: Personal Information --}}
        <h4 style="border-bottom:1px solid #eee; padding-bottom:0.5rem; color:#4b5563;">Personal Information</h4>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1.5rem;">
            <div><strong>Name:</strong> {{ $memberRegistration->name }}</div>
            <div>
                <strong>Image:</strong><br>
                @if($memberRegistration->image)
                    <img src="{{ asset('storage/' . $memberRegistration->image) }}" alt="Image"
                        style="width:100px; height:100px; object-fit:cover; border-radius:0.25rem;">
                @else
                    N/A
                @endif
            </div>
            <div><strong>Father's Name:</strong> {{ $memberRegistration->father_name }}</div>
            <div><strong>Mother's Name:</strong> {{ $memberRegistration->mother_name }}</div>
            <div><strong>Family Member Num:</strong> {{ $memberRegistration->family_member_num }}</div>
            <div><strong>NID No:</strong> {{ $memberRegistration->nid_no }}</div>
            <div><strong>Phone:</strong> {{ $memberRegistration->phone }}</div>
            <div><strong>Religion:</strong> {{ $memberRegistration->religion }}</div>
            <div><strong>Nationality:</strong> {{ $memberRegistration->nationality }}</div>
            <div><strong>Marital Status:</strong> {{ $memberRegistration->merital_status }}</div>
        </div>

        {{-- 2nd Section: Permanent Address --}}
        <h4 style="border-bottom:1px solid #eee; padding-bottom:0.5rem; color:#4b5563;">Permanent Address</h4>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1.5rem;">
            <div><strong>Village:</strong> {{ $memberRegistration->village_permanent }}</div>
            <div><strong>Post Name:</strong> {{ $memberRegistration->post_name_permanent }}</div>
            <div><strong>Thana/Upozilla:</strong> {{ $memberRegistration->thana_upozilla_permanent }}</div>
            <div><strong>Block:</strong> {{ $memberRegistration->block_permanent }}</div>
            <div><strong>District:</strong> {{ $memberRegistration->district_permanent }}</div>
            <div><strong>Post Code:</strong> {{ $memberRegistration->post_code_permanent }}</div>
        </div>

        {{-- 3rd Section: Present Address --}}
        <h4 style="border-bottom:1px solid #eee; padding-bottom:0.5rem; color:#4b5563;">Present Address</h4>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1.5rem;">
            <div><strong>Road:</strong> {{ $memberRegistration->road_present }}</div>
            <div><strong>Post Name:</strong> {{ $memberRegistration->post_name_present }}</div>
            <div><strong>Thana/Upozilla:</strong> {{ $memberRegistration->thana_upozilla_present }}</div>
            <div><strong>Block:</strong> {{ $memberRegistration->block_present }}</div>
            <div><strong>District:</strong> {{ $memberRegistration->district_present }}</div>
            <div><strong>Post Code:</strong> {{ $memberRegistration->post_code_present }}</div>
        </div>

        {{-- 4th Section: Sponsor Information --}}
        <h4 style="border-bottom:1px solid #eee; padding-bottom:0.5rem; color:#4b5563;">Sponsor Information</h4>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1.5rem;">
            <div><strong>Sponsor Name:</strong> {{ $memberRegistration->sponsor_name }}</div>
            <div><strong>Sponsor Phone:</strong> {{ $memberRegistration->sponsor_phone }}</div>
        </div>

        {{-- 5th Section: Attachments --}}
        <h4 style="border-bottom:1px solid #eee; padding-bottom:0.5rem; color:#4b5563;">Attachments</h4>
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap:1rem;">
            @if($memberRegistration->digital_sign)
                @php
                    $file = $memberRegistration->digital_sign;
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                    $isPdf = $ext === 'pdf';
                @endphp
                <div style="border:1px solid #e5e7eb; padding:0.75rem; border-radius:0.5rem; background:#fff; display:flex; flex-direction:column; justify-content:space-between;">
                    <div>
                        <div style="font-size:0.75rem; color:#6b7280; font-weight:600; margin-bottom:0.5rem; text-transform:uppercase;">Digital Sign</div>
                        
                        @if($isImage)
                            <div style="width:100%; height:120px; background:#f9fafb; border-radius:0.375rem; overflow:hidden; border:1px solid #f3f4f6; margin-bottom:0.75rem; display:flex; align-items:center; justify-content:center;">
                                <img src="{{ route('admin.member-registrations.view-file', ['filename' => basename($file)]) }}"
                                    style="max-width:100%; max-height:100%; object-fit:contain;">
                            </div>
                        @elseif($isPdf)
                            <div style="width:100%; height:120px; background:#fff1f2; border-radius:0.375rem; border:1px solid #fecaca; margin-bottom:0.75rem; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#dc2626; gap:0.5rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:32px; height:32px;" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                </svg>
                                <span style="font-size:0.75rem; font-weight:700;">PDF DOCUMENT</span>
                            </div>
                        @else
                            <div style="width:100%; height:120px; background:#f9fafb; border-radius:0.375rem; border:1px solid #f3f4f6; margin-bottom:0.75rem; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#6b7280; gap:0.5rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:32px; height:32px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <span style="font-size:0.75rem; font-weight:500;">{{ strtoupper($ext) }} DOCUMENT</span>
                            </div>
                        @endif
                    </div>

                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:0.5rem; margin-top: auto;">
                        <a href="{{ route('admin.member-registrations.view-file', ['filename' => basename($file)]) }}"
                            target="_blank" class="btn btn-sm btn-outline"
                            style="width:100%; text-align:center; padding: 0.4rem 0; font-size: 0.75rem;">View</a>
                        <a href="{{ route('admin.member-registrations.view-file', ['filename' => basename($file), 'download' => 1]) }}"
                            class="btn btn-sm btn-primary"
                            style="width:100%; text-align:center; padding: 0.4rem 0; font-size: 0.75rem;">Download</a>
                    </div>
                </div>
            @else
                <div style="font-size: 0.85rem; color: #6b7280;">No digital signature attached.</div>
            @endif
        </div>
    </div>
@endsection