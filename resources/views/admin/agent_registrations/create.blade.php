@extends('layouts.admin')

@section('title', 'Add Agent Registration')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Add Agent Registration</h1>
@endsection

@section('content')
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Fill in the details to register an agent.</div>
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

        <form action="{{ route('admin.agent-registrations.store') }}" method="POST">
            @csrf
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Full
                        Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Mobile
                        No</label>
                    <input type="text" name="mobile_no" value="{{ old('mobile_no') }}" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Business
                        Name</label>
                    <input type="text" name="business_name" value="{{ old('business_name') }}" required
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
                        <option value="retail" {{ old('business_type') == 'retail' ? 'selected' : '' }}>Retail</option>
                        <option value="wholesale" {{ old('business_type') == 'wholesale' ? 'selected' : '' }}>Wholesale
                        </option>
                        <option value="online" {{ old('business_type') == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="other" {{ old('business_type') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Time of
                        Business</label>
                    <input type="text" name="time_of_business" value="{{ old('time_of_business') }}" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label
                        style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">District</label>
                    <input type="text" name="district" value="{{ old('district') }}" required
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">NID No
                        (Optional)</label>
                    <input type="text" name="nid_no" value="{{ old('nid_no') }}"
                        style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Address</label>
                <textarea name="address" required rows="3"
                    style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">{{ old('address') }}</textarea>
            </div>

            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.25rem;">Description(Why do
                    you want to be an agent?)</label>
                <textarea name="description" required rows="4"
                    style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">{{ old('description') }}</textarea>
            </div>

            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn btn-primary">Create Agent Registration</button>
            </div>
        </form>
    </div>
@endsection