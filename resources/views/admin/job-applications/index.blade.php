@extends('layouts.admin')

@section('title', 'Job Applications')

@section('header')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 style="font-size: 1.1rem; font-weight: 600;">Job Applications</h1>
        <a href="{{ route('admin.vacancies.index') }}" class="btn btn-outline"
            style="text-decoration: none; margin-left: 20px;">
            Manage Vacancies
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage job applications submitted by candidates.</div>
        </div>

        @if (session('success'))
            <div
                style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('success') }}
            </div>
        @endif

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
                <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:0.5rem 0.25rem;">SL</th>
                    <th style="padding:0.5rem 0.25rem;">Full Name</th>
                    <th style="padding:0.5rem 0.25rem;">Email</th>
                    <th style="padding:0.5rem 0.25rem;">Mobile</th>
                    <th style="padding:0.5rem 0.25rem;">Applied For</th>
                    <th style="padding:0.5rem 0.25rem;">Date</th>
                    <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobApplications as $application)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:0.5rem 0.25rem;">{{ $loop->iteration }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $application->full_name }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $application->email }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $application->mobile_no }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $application->apply_for_post }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $application->created_at->format('d M Y') }}</td>
                        <td style="padding:0.5rem 0.25rem; text-align:right;">
                            <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                                <a href="{{ route('admin.job-applications.show', $application) }}" class="btn btn-outline">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.job-applications.destroy', $application) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline" style="color:#b91c1c; border-color:#b91c1c;"
                                        onclick="return confirm('Are you sure you want to delete this application?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                            No job applications found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection