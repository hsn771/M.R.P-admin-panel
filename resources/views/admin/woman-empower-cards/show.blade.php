@extends('layouts.admin')

@section('title', 'View Woman Empower Card')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">View Woman Empower Card</h1>
@endsection

@section('content')
    <div class="card">
        <div style="margin-bottom:1rem;">
            <a href="{{ route('admin.woman-empower-cards.index') }}" class="btn btn-outline" style="margin-bottom:1rem;">← Back to List</a>
        </div>

        <div style="display:grid; gap:1rem; max-width:800px;">
            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">ID</div>
                <div style="font-size:0.9rem; font-weight:500;">#{{ $womanEmpowerCard->id }}</div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">নাম (Name)</div>
                <div style="font-size:0.9rem; font-weight:500;">{{ $womanEmpowerCard->name }}</div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                    <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">বয়স (Age)</div>
                    <div style="font-size:0.9rem; font-weight:500;">{{ $womanEmpowerCard->age }}</div>
                </div>

                <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                    <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">ভোটার আইডি (Voter ID)</div>
                    <div style="font-size:0.9rem; font-weight:500;">{{ $womanEmpowerCard->voter_id }}</div>
                </div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">স্বামী/পিতার নাম (Husband/Father Name)</div>
                <div style="font-size:0.9rem; font-weight:500;">{{ $womanEmpowerCard->husband_father_name }}</div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">মায়ের নাম (Mother Name)</div>
                <div style="font-size:0.9rem; font-weight:500;">{{ $womanEmpowerCard->mother_name }}</div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">ঠিকানা (Address)</div>
                <div style="font-size:0.9rem; white-space:pre-wrap; line-height:1.6;">{{ $womanEmpowerCard->address }}</div>
            </div>

            <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Submitted At</div>
                <div style="font-size:0.9rem;">{{ $womanEmpowerCard->created_at->format('F d, Y \a\t h:i A') }}</div>
            </div>
        </div>

        <div style="margin-top:1.5rem; display:flex; gap:0.5rem;">
            <form action="{{ route('admin.woman-empower-cards.destroy', $womanEmpowerCard) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline" 
                        style="color:#b91c1c; border-color:#b91c1c;"
                        onclick="return confirm('Are you sure you want to delete this card?')">
                    Delete Card
                </button>
            </form>
        </div>
    </div>
@endsection
