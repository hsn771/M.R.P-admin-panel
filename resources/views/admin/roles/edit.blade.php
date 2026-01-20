@extends('layouts.admin')

@section('title', 'Edit role')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit role</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.roles.update', $role) }}" style="max-width:480px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:0.75rem;">
                <label for="name" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $role->name) }}" required
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('name')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <div style="font-size:0.85rem; margin-bottom:0.25rem;">Permissions</div>
                <div style="display:flex; flex-wrap:wrap; gap:0.2rem 0.75rem; font-size:0.85rem; max-height:200px; overflow-y:auto;">
                    @php
                        $selectedPermissions = old('permissions', $role->permissions->pluck('name')->toArray());
                    @endphp
                    @forelse($permissions as $permission)
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                   {{ in_array($permission->name, (array) $selectedPermissions, true) ? 'checked' : '' }}>
                            {{ $permission->name }}
                        </label>
                    @empty
                        <span class="muted">No permissions yet. Create some under Permissions.</span>
                    @endforelse
                </div>
                @error('permissions')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection


