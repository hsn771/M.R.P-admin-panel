@extends('layouts.admin')

@section('title', 'Share Investment Details')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Share Investment Details</h1>
@endsection

@php
    $si = $shareInvestment;
    $labelStyle = 'display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;';
    $valueStyle = 'font-size:0.95rem; color:#111827; font-weight:500;';
    $sectionStyle = 'font-size:0.95rem; font-weight:600; color:#166534; border-bottom:1px solid #e5e7eb; padding-bottom:0.4rem; margin:1.5rem 0 1rem;';
    $gridStyle = 'display:grid; grid-template-columns: 1fr 1fr; gap:1.25rem;';
@endphp

@section('content')
    <div class="card" style="max-width: 900px; margin: 0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Application No: <strong>{{ $si->application_no }}</strong> · {{ $si->created_at->format('d M Y, h:i A') }}</div>
            <div style="display:flex; gap:0.5rem;">
                <button type="button" class="btn btn-outline" onclick="window.print()">Print</button>
                <a href="{{ route('admin.share-investments.index') }}" class="btn btn-outline">Back to List</a>
            </div>
        </div>

        <div style="display:flex; gap:1.5rem; flex-wrap:wrap;">
            @foreach (['customer_photo' => 'গ্রাহকের ছবি', 'nominee_photo' => 'নমিনির ছবি'] as $field => $label)
                <div>
                    <label style="{{ $labelStyle }}">{{ $label }}</label>
                    @if ($si->{$field})
                        <img src="{{ route('admin.share-investments.view-file', ['filename' => basename($si->{$field})]) }}" alt="{{ $label }}"
                            style="width:120px; height:150px; object-fit:cover; border:1px solid #e5e7eb; border-radius:0.5rem;">
                    @else
                        <div class="muted">—</div>
                    @endif
                </div>
            @endforeach
        </div>

        <div style="{{ $sectionStyle }}">১. গ্রাহকের তথ্য (আবেদনকারী)</div>
        <div style="{{ $gridStyle }}">
            <div><label style="{{ $labelStyle }}">Name</label><div style="{{ $valueStyle }}">{{ $si->customer_name }}</div></div>
            <div><label style="{{ $labelStyle }}">Phone</label><div style="{{ $valueStyle }}">{{ $si->customer_phone }}</div></div>
            <div><label style="{{ $labelStyle }}">Member ID</label><div style="{{ $valueStyle }}">{{ $si->member_id ?: '—' }}</div></div>
            <div></div>
            <div><label style="{{ $labelStyle }}">Permanent Address</label><div style="{{ $valueStyle }}">{{ $si->address('customer_permanent') }}</div></div>
            <div><label style="{{ $labelStyle }}">Present Address</label><div style="{{ $valueStyle }}">{{ $si->address('customer_present') }}</div></div>
        </div>

        <div style="{{ $sectionStyle }}">২. নমিনির তথ্য</div>
        <div style="{{ $gridStyle }}">
            <div style="grid-column: 1 / -1;"><label style="{{ $labelStyle }}">Nominee Name</label><div style="{{ $valueStyle }}">{{ $si->nominee_name }}</div></div>
            <div><label style="{{ $labelStyle }}">Permanent Address</label><div style="{{ $valueStyle }}">{{ $si->address('nominee_permanent') }}</div></div>
            <div><label style="{{ $labelStyle }}">Present Address</label><div style="{{ $valueStyle }}">{{ $si->address('nominee_present') }}</div></div>
        </div>

        <div style="{{ $sectionStyle }}">৩. শেয়ার বিনিয়োগের বিবরণ</div>
        <div style="{{ $gridStyle }}">
            <div><label style="{{ $labelStyle }}">Category</label><div style="{{ $valueStyle }}">{{ $si->category_label }}</div></div>
            <div><label style="{{ $labelStyle }}">Duration</label><div style="{{ $valueStyle }}">{{ $si->investment_duration }}</div></div>
            <div><label style="{{ $labelStyle }}">Amount (৳)</label><div style="{{ $valueStyle }}">{{ number_format($si->investment_amount, 2) }}</div></div>
            <div><label style="{{ $labelStyle }}">Amount in Words</label><div style="{{ $valueStyle }}">{{ $si->investment_amount_in_words }}</div></div>
        </div>

        <div style="{{ $sectionStyle }}">৪. স্পন্সরের তথ্য (পরিচয়দানকারী)</div>
        <div style="{{ $gridStyle }}">
            <div><label style="{{ $labelStyle }}">Sponsor Name</label><div style="{{ $valueStyle }}">{{ $si->sponsor_name ?: '—' }}</div></div>
            <div><label style="{{ $labelStyle }}">ID / Mobile</label><div style="{{ $valueStyle }}">{{ $si->sponsor_id_mobile ?: '—' }}</div></div>
        </div>

        <div style="{{ $sectionStyle }}">গ্রাহকের স্বাক্ষর</div>
        @if ($si->digital_sign)
            <img src="{{ route('admin.share-investments.view-file', ['filename' => basename($si->digital_sign)]) }}" alt="Signature"
                style="max-width:300px; border:1px solid #e5e7eb; border-radius:0.5rem; background:#fff;">
        @else
            <div class="muted">—</div>
        @endif
    </div>
@endsection
