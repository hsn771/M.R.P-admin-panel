@extends('layouts.admin')

@section('title', 'Roles')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Roles</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Define roles and attach permissions.</div>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"
                style="background: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem;">
                <i class="fas fa-plus" style="margin-right: 0.5rem;"></i>New role
            </a>
        </div>

        @if (session('status'))
            <div
                style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('status') }}
            </div>
        @endif

        <div class="table-responsive">
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
                            <td style="padding:0.75rem 0.25rem; max-width: 400px;">
                                <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
                                    @forelse($role->permissions as $perm)
                                        <span
                                            style="font-size: 0.75rem; background: #f3f4f6; color: #4b5563; padding: 0.1rem 0.4rem; border-radius: 9999px; border: 1px solid #e5e7eb;">
                                            {{ $perm->name }}
                                        </span>
                                    @empty
                                        <span style="color: #9ca3af;">—</span>
                                    @endforelse
                                </div>
                            </td>
                            <td style="padding:0.5rem 0.25rem; text-align:right;">
                                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-outline">
                                    <i class="fas fa-edit" style="margin-right: 0.3rem;"></i>
                                </a>
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
    </div>
@endsection