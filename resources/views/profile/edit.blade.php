@extends('layouts.admin')

@section('title', 'Profile')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">My profile</h1>
@endsection

@section('content')
    <div class="card" style="max-width: 520px;">
        @if (session('status'))
            <div style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="name" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Name</label>
                <input id="name" name="name" type="text"
                       value="{{ old('name', $user->name) }}" required
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('name')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Email</label>
                <div style="padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #e5e7eb; background:#f9fafb;">
                    {{ $user->email }}
                </div>
            </div>

            <hr style="border:none; border-top:1px solid #e5e7eb; margin:1rem 0;">

            <div style="margin-bottom:0.5rem; font-size:0.9rem; font-weight:500;">
                Change password
            </div>
            <p class="muted" style="margin-bottom:0.75rem;">
                Leave password fields blank if you do not want to change your password.
            </p>

            <div style="margin-bottom:0.75rem;">
                <label for="current_password" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">
                    Current password
                </label>
                <input id="current_password" name="current_password" type="password"
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('current_password')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="password" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">
                    New password
                </label>
                <input id="password" name="password" type="password"
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('password')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="password_confirmation" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">
                    Confirm new password
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
            </div>

            <div style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
@endsection


