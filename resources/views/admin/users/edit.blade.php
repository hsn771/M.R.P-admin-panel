@extends('layouts.admin')

@section('title', 'Edit user')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit user</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" style="max-width:480px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="name" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('name')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="email" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('email')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="password" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">
                    New password <span class="muted">(leave blank to keep current)</span>
                </label>
                <input id="password" name="password" type="password"
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('password')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <div style="font-size:0.85rem; margin-bottom:0.25rem;">Roles</div>
                <div style="display:flex; flex-wrap:wrap; gap:0.2rem 0.75rem; font-size:0.85rem;">
                    @php
                        $selectedRoles = old('roles', $user->getRoleNames()->toArray());
                    @endphp
                    @forelse($roles as $role)
                        <label>
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                   {{ in_array($role->name, (array) $selectedRoles, true) ? 'checked' : '' }}>
                            {{ $role->name }}
                        </label>
                    @empty
                        <span class="muted">No roles yet. Create one under Roles.</span>
                    @endforelse
                </div>
                @error('roles')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection


