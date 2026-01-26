@extends('layouts.admin')

@section('title', 'Create Member Registration')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Create Member Registration</h1>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('admin.member-registrations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- 1st Section: Personal Information --}}
            <h3
                style="margin-top:0; margin-bottom:1rem; border-bottom:1px solid #eee; padding-bottom:0.5rem; color:#4b5563;">
                Personal Information</h3>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:2rem;">
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Father's Name</label>
                    <input type="text" name="father_name" class="form-control" required value="{{ old('father_name') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Mother's Name</label>
                    <input type="text" name="mother_name" class="form-control" required value="{{ old('mother_name') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Family Member Num</label>
                    <input type="number" name="family_member_num" class="form-control" required
                        value="{{ old('family_member_num') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">NID No</label>
                    <input type="text" name="nid_no" class="form-control" required value="{{ old('nid_no') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Phone</label>
                    <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Religion</label>
                    <input type="text" name="religion" class="form-control" required value="{{ old('religion') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Nationality</label>
                    <input type="text" name="nationality" class="form-control" required value="{{ old('nationality') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Marital Status</label>
                    <select name="merital_status" class="form-control" required>
                        <option value="">Select Status</option>
                        <option value="Single" {{ old('merital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('merital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Divorced" {{ old('merital_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="Widowed" {{ old('merital_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                </div>
            </div>

            {{-- 2nd Section: Permanent Address --}}
            <h3 style="margin-bottom:1rem; border-bottom:1px solid #eee; padding-bottom:0.5rem; color:#4b5563;">Permanent
                Address</h3>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:2rem;">
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Village</label>
                    <input type="text" name="village_permanent" class="form-control" required
                        value="{{ old('village_permanent') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Post Name</label>
                    <input type="text" name="post_name_permanent" class="form-control" required
                        value="{{ old('post_name_permanent') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Thana/Upozilla</label>
                    <input type="text" name="thana_upozilla_permanent" class="form-control" required
                        value="{{ old('thana_upozilla_permanent') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Block</label>
                    <input type="text" name="block_permanent" class="form-control" required
                        value="{{ old('block_permanent') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">District</label>
                    <input type="text" name="district_permanent" class="form-control" required
                        value="{{ old('district_permanent') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Post Code</label>
                    <input type="text" name="post_code_permanent" class="form-control" required
                        value="{{ old('post_code_permanent') }}">
                </div>
            </div>

            {{-- 3rd Section: Present Address --}}
            <h3 style="margin-bottom:1rem; border-bottom:1px solid #eee; padding-bottom:0.5rem; color:#4b5563;">Present
                Address</h3>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:2rem;">
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Road</label>
                    <input type="text" name="road_present" class="form-control" required value="{{ old('road_present') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Post Name</label>
                    <input type="text" name="post_name_present" class="form-control" required
                        value="{{ old('post_name_present') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Thana/Upozilla</label>
                    <input type="text" name="thana_upozilla_present" class="form-control" required
                        value="{{ old('thana_upozilla_present') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Block</label>
                    <input type="text" name="block_present" class="form-control" required
                        value="{{ old('block_present') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">District</label>
                    <input type="text" name="district_present" class="form-control" required
                        value="{{ old('district_present') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Post Code</label>
                    <input type="text" name="post_code_present" class="form-control" required
                        value="{{ old('post_code_present') }}">
                </div>
            </div>

            {{-- 4th Section: Sponsor Information --}}
            <h3 style="margin-bottom:1rem; border-bottom:1px solid #eee; padding-bottom:0.5rem; color:#4b5563;">Sponsor
                Information</h3>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:2rem;">
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Sponsor Name</label>
                    <input type="text" name="sponsor_name" class="form-control" required value="{{ old('sponsor_name') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Sponsor Phone</label>
                    <input type="text" name="sponsor_phone" class="form-control" required
                        value="{{ old('sponsor_phone') }}">
                </div>
                <div>
                    <label style="display:block; margin-bottom:0.25rem;">Digital Sign</label>
                    <input type="file" name="digital_sign" class="form-control">
                </div>
            </div>

            <div style="text-align:right;">
                <button type="submit" class="btn btn-primary" style="padding: 0.5rem 2rem;">Save Registration</button>
            </div>
        </form>
    </div>
@endsection