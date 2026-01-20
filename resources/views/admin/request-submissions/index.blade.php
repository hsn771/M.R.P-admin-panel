@extends('layouts.admin')

@section('title', 'Request Submissions')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Request Submissions</h1>
@endsection

@section('content')
    @if (session('status'))
        <div style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
            {{ session('status') }}
        </div>
    @endif

    <div class="card" style="margin-bottom:1.5rem;">
        <div style="margin-bottom:1rem;">
            <h2 style="font-size:1rem; font-weight:600; margin-bottom:0.5rem;">Frontend Form Image</h2>
            <div class="muted" style="font-size:0.85rem;">Manage the image displayed on the request submission form page.</div>
        </div>

        <form method="POST" action="{{ route('admin.request-submissions.update-form-image') }}" enctype="multipart/form-data" style="max-width:600px;">
            @csrf

            @if($formImage && $formImage->image)
                <div style="margin-bottom:1rem;">
                    <div style="font-size:0.85rem; color:#6b7280; margin-bottom:0.5rem;">Current Image</div>
                    <img src="{{ asset('storage/' . $formImage->image) }}" alt="Form image" 
                         style="max-width:300px; max-height:300px; object-fit:cover; border-radius:0.5rem; border:1px solid #e5e7eb;">
                </div>
            @endif

            <div style="margin-bottom:0.75rem;">
                <label for="image" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">{{ $formImage && $formImage->image ? 'Update Image' : 'Upload Image' }}</label>
                <input id="image" name="image" type="file" accept="image/*" {{ !$formImage || !$formImage->image ? 'required' : '' }}
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                <div class="muted" style="margin-top:0.25rem; font-size:0.75rem;">
                    Accepted formats: JPEG, PNG, JPG, GIF, WEBP. Max size: 2MB
                </div>
                @error('image')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">{{ $formImage && $formImage->image ? 'Update Image' : 'Upload Image' }}</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">View and manage request submissions from the frontend form.</div>
        </div>

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
            <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                <th style="padding:0.5rem 0.25rem;">ID</th>
                <th style="padding:0.5rem 0.25rem;">Name</th>
                <th style="padding:0.5rem 0.25rem;">Subject</th>
                <th style="padding:0.5rem 0.25rem;">Mobile</th>
                <th style="padding:0.5rem 0.25rem;">Email</th>
                <th style="padding:0.5rem 0.25rem;">Status</th>
                <th style="padding:0.5rem 0.25rem;">Submitted</th>
                <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($submissions as $submission)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:0.5rem 0.25rem;">{{ $submission->id }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $submission->name }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ Str::limit($submission->subject, 30) }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $submission->mobile_number }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $submission->email ?: '—' }}</td>
                    <td style="padding:0.5rem 0.25rem;">
                        <span style="padding:0.25rem 0.5rem; border-radius:0.25rem; font-size:0.8rem; 
                            @if($submission->status === 'মীমাংসিত') background:#ecfdf5; color:#166534;
                            @elseif($submission->status === 'অমীমাংসিত') background:#fef2f2; color:#991b1b;
                            @else background:#eff6ff; color:#1e40af;
                            @endif">
                            {{ $submission->status ?? 'চলমান' }}
                        </span>
                    </td>
                    <td style="padding:0.5rem 0.25rem;">{{ $submission->created_at->format('M d, Y H:i') }}</td>
                    <td style="padding:0.5rem 0.25rem; text-align:right;">
                        <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                            <a href="{{ route('admin.request-submissions.show', $submission) }}" class="btn btn-outline">View</a>
                            <form action="{{ route('admin.request-submissions.destroy', $submission) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" 
                                        style="color:#b91c1c; border-color:#b91c1c;"
                                        onclick="return confirm('Are you sure you want to delete this submission?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                        No submissions found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:0.75rem;">
            {{ $submissions->links() }}
        </div>
    </div>
@endsection

