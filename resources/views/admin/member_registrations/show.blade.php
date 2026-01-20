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
    </div>
@endsection