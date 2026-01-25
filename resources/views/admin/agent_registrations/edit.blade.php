@extends('layouts.admin')

@section('title', 'Edit Agent Registration')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit Agent Registration</h1>
@endsection

@section('content')
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Update agent registration details.</div>
            <a href="{{ route('admin.agent-registrations.index') }}" class="btn btn-outline">Back to List</a>
        </div>

        @if ($errors->any())
            <div
                style="padding:0.75rem; border-radius:0.5rem; background:#fee2e2; color:#991b1b; font-size:0.85rem; margin-bottom:1rem;">
                <ul style="margin:0; padding-left:1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.agent-registrations.update', $agentRegistration) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Full
                        Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $agentRegistration->full_name) }}"
                        required style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Mobile
                        No</label>
                    <input type="text" name="mobile_no" value="{{ old('mobile_no', $agentRegistration->mobile_no) }}"
                        required style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Email</label>
                    <input type="email" name="email" value="{{ old('email', $agentRegistration->email) }}" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Business
                        Name</label>
                    <input type="text" name="business_name"
                        value="{{ old('business_name', $agentRegistration->business_name) }}" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Business
                        Type</label>
                    <select name="business_type" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                        <option value="">Select Type</option>
                        <option value="retail" {{ old('business_type', $agentRegistration->business_type) == 'retail' ? 'selected' : '' }}>Retail</option>
                        <option value="wholesale" {{ old('business_type', $agentRegistration->business_type) == 'wholesale' ? 'selected' : '' }}>Wholesale</option>
                        <option value="online" {{ old('business_type', $agentRegistration->business_type) == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="other" {{ old('business_type', $agentRegistration->business_type) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Time of
                        Business</label>
                    <input type="text" name="time_of_business"
                        value="{{ old('time_of_business', $agentRegistration->time_of_business) }}" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label
                        style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">District</label>
                    <input type="text" name="district" value="{{ old('district', $agentRegistration->district) }}" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">NID No
                        (Optional)</label>
                    <input type="text" name="nid_no" value="{{ old('nid_no', $agentRegistration->nid_no) }}"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Address</label>
                <textarea name="address" required rows="3"
                    style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">{{ old('address', $agentRegistration->address) }}</textarea>
            </div>

            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Description(Why do
                    you want to be an agent?)</label>
                <textarea name="description" required rows="4"
                    style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">{{ old('description', $agentRegistration->description) }}</textarea>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Birth
                        Certificate</label>
                    <input type="file" name="birth_certificate"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($agentRegistration->birth_certificate)
                        <a href="{{ asset('storage/' . $agentRegistration->birth_certificate) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">NID
                        File</label>
                    <input type="file" name="nid_file"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($agentRegistration->nid_file)
                        <a href="{{ asset('storage/' . $agentRegistration->nid_file) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Photo
                        Upload (Max 2)</label>
                    <input type="file" name="photo_up[]" multiple max="2"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($agentRegistration->photo_up)
                        @foreach(is_array($agentRegistration->photo_up) ? $agentRegistration->photo_up : [$agentRegistration->photo_up] as $photo)
                            <a href="{{ asset('storage/' . $photo) }}" target="_blank"
                                style="font-size:0.8rem; color:#2563eb; display:block;">View Existing</a>
                        @endforeach
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Chairman
                        Certificate</label>
                    <input type="file" name="chairman_certificate"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($agentRegistration->chairman_certificate)
                        <a href="{{ asset('storage/' . $agentRegistration->chairman_certificate) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Husband's
                        Info</label>
                    <input type="file" name="husbands_information"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($agentRegistration->husbands_information)
                        <a href="{{ asset('storage/' . $agentRegistration->husbands_information) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Considerable
                        Person Sign</label>
                    <input type="file" name="considerable_person_sign"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($agentRegistration->considerable_person_sign)
                        <a href="{{ asset('storage/' . $agentRegistration->considerable_person_sign) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Bank
                        Check</label>
                    <input type="file" name="bank_check"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($agentRegistration->bank_check)
                        <a href="{{ asset('storage/' . $agentRegistration->bank_check) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Trade
                        License</label>
                    <input type="file" name="trade_license"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($agentRegistration->trade_license)
                        <a href="{{ asset('storage/' . $agentRegistration->trade_license) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Digital
                        Sign</label>
                    <input type="file" name="digital_sign"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($agentRegistration->digital_sign)
                        <a href="{{ asset('storage/' . $agentRegistration->digital_sign) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn btn-primary">Update Agent Registration</button>
            </div>
        </form>
    </div>
@endsection