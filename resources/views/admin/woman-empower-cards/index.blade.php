@extends('layouts.admin')

@section('title', 'Woman Empower Cards')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Woman Empower Cards</h1>
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
            <div class="muted" style="font-size:0.85rem;">Manage the image displayed on the woman empower card form page.</div>
        </div>

        <form method="POST" action="{{ route('admin.woman-empower-cards.update-form-image') }}" enctype="multipart/form-data" style="max-width:600px;">
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
            <div class="muted">View and manage woman empower cards from the frontend form.</div>
        </div>

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
            <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                <th style="padding:0.5rem 0.25rem;">ID</th>
                <th style="padding:0.5rem 0.25rem;">Name</th>
                <th style="padding:0.5rem 0.25rem;">Age</th>
                <th style="padding:0.5rem 0.25rem;">Husband/Father Name</th>
                <th style="padding:0.5rem 0.25rem;">Mother Name</th>
                <th style="padding:0.5rem 0.25rem;">Voter ID</th>
                <th style="padding:0.5rem 0.25rem;">Submitted</th>
                <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($cards as $card)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:0.5rem 0.25rem;">{{ $card->id }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $card->name }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $card->age }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $card->husband_father_name }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $card->mother_name }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $card->voter_id }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $card->created_at->format('M d, Y H:i') }}</td>
                    <td style="padding:0.5rem 0.25rem; text-align:right;">
                        <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                            <a href="{{ route('admin.woman-empower-cards.show', $card) }}" class="btn btn-outline">View</a>
                            <form action="{{ route('admin.woman-empower-cards.destroy', $card) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" 
                                        style="color:#b91c1c; border-color:#b91c1c;"
                                        onclick="return confirm('Are you sure you want to delete this card?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                        No cards found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:0.75rem;">
            {{ $cards->links() }}
        </div>
    </div>
@endsection
