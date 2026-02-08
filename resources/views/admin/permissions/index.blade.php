@extends('layouts.admin')

@section('title', 'Permissions')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Permissions</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Fine-grained capabilities that can be attached to roles.</div>
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary"
                style="background: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem;">
                <i class="fas fa-plus" style="margin-right: 0.5rem;"></i>New permission
            </a>
        </div>

        @if (session('status'))
            <div
                style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('status') }}
            </div>
        @endif

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
                <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:0.5rem 0.25rem;">Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $permission)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:0.5rem 0.25rem;">{{ $permission->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                            No permissions found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection