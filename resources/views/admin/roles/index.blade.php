@extends('layouts.admin')

@section('title', 'Roles')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Roles</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Define roles and attach permissions.</div>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">New role</a>
        </div>

        @if (session('status'))
            <div style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('status') }}
            </div>
        @endif

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
            <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                <th style="padding:0.5rem 0.25rem;">Name</th>
                <th style="padding:0.5rem 0.25rem;">Permissions</th>
                <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($roles as $role)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:0.5rem 0.25rem;">{{ $role->name }}</td>
                    <td style="padding:0.5rem 0.25rem;">
                        {{ $role->permissions->pluck('name')->implode(', ') ?: '—' }}
                    </td>
                    <td style="padding:0.5rem 0.25rem; text-align:right;">
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-outline">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                        No roles found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection


