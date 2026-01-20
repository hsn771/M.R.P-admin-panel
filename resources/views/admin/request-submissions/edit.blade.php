@extends('layouts.admin')

@section('title', 'Edit Request Submission Status')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit Request Submission Status</h1>
@endsection

@section('content')
    <div class="card">
        <div style="margin-bottom:1rem;">
            <a href="{{ route('admin.request-submissions.show', $requestSubmission) }}" class="btn btn-outline" style="margin-bottom:1rem;">← Back to View</a>
        </div>

        <form method="POST" action="{{ route('admin.request-submissions.update', $requestSubmission) }}" style="max-width:600px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="status" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Status</label>
                <select id="status" name="status" required
                        style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                    <option value="চলমান" {{ old('status', $requestSubmission->status) === 'চলমান' ? 'selected' : '' }}>চলমান</option>
                    <option value="মীমাংসিত" {{ old('status', $requestSubmission->status) === 'মীমাংসিত' ? 'selected' : '' }}>মীমাংসিত</option>
                    <option value="অমীমাংসিত" {{ old('status', $requestSubmission->status) === 'অমীমাংসিত' ? 'selected' : '' }}>অমীমাংসিত</option>
                </select>
                @error('status')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('admin.request-submissions.show', $requestSubmission) }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection
