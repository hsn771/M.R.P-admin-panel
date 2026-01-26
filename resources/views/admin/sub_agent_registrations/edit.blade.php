@extends('layouts.admin')

@section('title', 'Edit Sub Agent Registration')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit Sub Agent Registration</h1>
@endsection

@section('content')
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Update sub agent registration details.</div>
            <a href="{{ route('admin.sub-agent-registrations.index') }}" class="btn btn-outline">Back to List</a>
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

        <form action="{{ route('admin.sub-agent-registrations.update', $subAgentRegistration) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Full
                        Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $subAgentRegistration->full_name) }}"
                        required style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Mobile
                        No</label>
                    <input type="text" name="mobile_no" value="{{ old('mobile_no', $subAgentRegistration->mobile_no) }}"
                        required style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Email</label>
                    <input type="email" name="email" value="{{ old('email', $subAgentRegistration->email) }}" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
                <div>
                    <label
                        style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">District</label>
                    <input type="text" name="district" value="{{ old('district', $subAgentRegistration->district) }}"
                        required style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">NID No
                    (Optional)</label>
                <input type="text" name="nid_no" value="{{ old('nid_no', $subAgentRegistration->nid_no) }}"
                    style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
            </div>

            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Address</label>
                <textarea name="address" required rows="3"
                    style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">{{ old('address', $subAgentRegistration->address) }}</textarea>
            </div>

            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Description(Why do
                    you want to be a sub agent?)</label>
                <textarea name="description" required rows="4"
                    style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">{{ old('description', $subAgentRegistration->description) }}</textarea>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Birth
                        Certificate</label>
                    <input type="file" name="birth_certificate"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($subAgentRegistration->birth_certificate)
                        <a href="{{ asset('storage/' . $subAgentRegistration->birth_certificate) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">NID
                        File</label>
                    <input type="file" name="nid_file"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($subAgentRegistration->nid_file)
                        <a href="{{ asset('storage/' . $subAgentRegistration->nid_file) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Photo / PDF
                        (Max 2)</label>
                    <input type="file" name="photo_up[]" multiple max="2"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($subAgentRegistration->photo_up)
                        @foreach(is_array($subAgentRegistration->photo_up) ? $subAgentRegistration->photo_up : [$subAgentRegistration->photo_up] as $photo)
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
                    @if($subAgentRegistration->chairman_certificate)
                        <a href="{{ asset('storage/' . $subAgentRegistration->chairman_certificate) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Husband's
                        Info</label>
                    <input type="file" name="husbands_information"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($subAgentRegistration->husbands_information)
                        <a href="{{ asset('storage/' . $subAgentRegistration->husbands_information) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Considerable
                        Person Sign</label>
                    <input type="file" name="considerable_person_sign"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($subAgentRegistration->considerable_person_sign)
                        <a href="{{ asset('storage/' . $subAgentRegistration->considerable_person_sign) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Bank
                        Check</label>
                    <input type="file" name="bank_check"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($subAgentRegistration->bank_check)
                        <a href="{{ asset('storage/' . $subAgentRegistration->bank_check) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Trade
                        License</label>
                    <input type="file" name="trade_license"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($subAgentRegistration->trade_license)
                        <a href="{{ asset('storage/' . $subAgentRegistration->trade_license) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Digital
                        Sign</label>
                    <input type="file" name="digital_sign"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                    @if($subAgentRegistration->digital_sign)
                        <a href="{{ asset('storage/' . $subAgentRegistration->digital_sign) }}" target="_blank"
                            style="font-size:0.8rem; color:#2563eb;">View Existing</a>
                    @endif
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn btn-primary">Update Sub Agent Registration</button>
            </div>
        </form>
    </div>
@endsection