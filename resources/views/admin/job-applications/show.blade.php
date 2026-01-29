@extends('layouts.admin')

@section('title', 'Job Application Details')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Job Application Details</h1>
@endsection

@section('content')
    <div class="card" style="max-width: 900px; margin: 0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <div class="muted">Detailed information for the job application.</div>
            <div style="display:flex; gap:0.5rem;">
                <a href="{{ route('admin.job-applications.index') }}" class="btn btn-outline">Back to List</a>
            </div>
        </div>

        <!-- Personal Information -->
        <div style="margin-bottom:2rem;">
            <h3 style="font-size:1rem; font-weight:600; margin-bottom:1rem; color:#111827;">Personal Information</h3>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem;">
                <div>
                    <label
                        style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Full
                        Name</label>
                    <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $jobApplication->full_name }}</div>
                </div>
                <div>
                    <label
                        style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Email</label>
                    <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $jobApplication->email }}</div>
                </div>
                <div>
                    <label
                        style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Mobile
                        Number</label>
                    <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $jobApplication->mobile_no }}</div>
                </div>
                <div>
                    <label
                        style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Applied
                        For Post</label>
                    <div style="font-size:1rem; color:#111827; font-weight:500;">{{ $jobApplication->apply_for_post }}</div>
                </div>
            </div>
        </div>

        <!-- Educational Qualifications -->
        <div style="margin-bottom:2rem;">
            <h3 style="font-size:1rem; font-weight:600; margin-bottom:1rem; color:#111827;">Educational Qualifications</h3>
            <div
                style="font-size:1rem; color:#111827; line-height:1.6; white-space: pre-wrap; background:#f9fafb; padding:1rem; border-radius:0.5rem;">
                {{ $jobApplication->educational_qualifications }}</div>
        </div>

        <!-- Work Experience -->
        @if($jobApplication->work_experience)
            <div style="margin-bottom:2rem;">
                <h3 style="font-size:1rem; font-weight:600; margin-bottom:1rem; color:#111827;">Work Experience</h3>
                <div
                    style="font-size:1rem; color:#111827; line-height:1.6; white-space: pre-wrap; background:#f9fafb; padding:1rem; border-radius:0.5rem;">
                    {{ $jobApplication->work_experience }}</div>
            </div>
        @endif

        <!-- Cover Letter -->
        <div style="margin-bottom:2rem;">
            <h3 style="font-size:1rem; font-weight:600; margin-bottom:1rem; color:#111827;">Cover Letter</h3>
            <div
                style="font-size:1rem; color:#111827; line-height:1.6; white-space: pre-wrap; background:#f9fafb; padding:1rem; border-radius:0.5rem;">
                {{ $jobApplication->cover_letter }}</div>
        </div>

        <!-- CV Upload -->
        <div style="margin-bottom:2rem;">
            <h3 style="font-size:1rem; font-weight:600; margin-bottom:1rem; color:#111827;">CV/Resume</h3>
            <div>
                <a href="{{ asset('storage/' . $jobApplication->cv_upload) }}" target="_blank" class="btn btn-outline"
                    style="display:inline-flex; align-items:center; gap:0.5rem;">
                    <i class="fa-solid fa-download"></i>
                    Download CV
                </a>
                <span style="margin-left:1rem; font-size:0.85rem; color:#6b7280;">
                    {{ basename($jobApplication->cv_upload) }}
                </span>
            </div>
        </div>

        <!-- Submission Date -->
        <div style="border-top:1px solid #f3f4f6; padding-top:1.5rem; margin-top:1.5rem;">
            <label
                style="display:block; font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:0.25rem;">Submitted
                Date</label>
            <div style="font-size:0.85rem; color:#4b5563;">{{ $jobApplication->created_at->format('d M Y, h:i A') }}</div>
        </div>
    </div>
@endsection