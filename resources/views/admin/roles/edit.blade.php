@extends('layouts.admin')

@section('title', 'Edit role')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit role</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')

            <div style="max-width: 480px; margin-bottom: 1.5rem;">
                <label for="name" style="display:block; font-size:0.85rem; font-weight: 500; margin-bottom:0.5rem; color: #374151;">Role Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $role->name) }}" required
                       style="width:100%; padding:0.6rem 0.75rem; border-radius:0.5rem; border:1px solid #d1d5db; transition: border-color 0.2s;">
                @error('name')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:1.5rem;">
                <div style="font-size:0.85rem; font-weight: 500; margin-bottom:0.75rem; color: #374151;">Assign Permissions</div>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 0.75rem;">
                    @php
                        $selectedPermissions = old('permissions', $role->permissions->pluck('name')->toArray());
                    @endphp
                    @forelse($permissions as $permission)
                        <label style="display: flex; align-items: start; gap: 0.6rem; padding: 0.6rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; background: #fff;">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                   style="margin-top: 0.15rem; width: 1.1rem; height: 1.1rem; accent-color: #2563eb;"
                                   {{ in_array($permission->name, (array) $selectedPermissions, true) ? 'checked' : '' }}>
                            <span style="font-size: 0.85rem; color: #4b5563; line-height: 1.4;">{{ $permission->name }}</span>
                        </label>
                    @empty
                        <span style="color: #6b7280; font-style: italic;">No permissions available.</span>
                    @endforelse
                </div>
                @error('permissions')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.4rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:2rem; display:flex; gap:0.75rem; padding-top: 1.5rem; border-top: 1px solid #f3f4f6;">
                <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1.5rem;">Save Changes</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline" style="padding: 0.5rem 1.5rem;">Cancel</a>
            </div>
        </form>
    </div>
@endsection


