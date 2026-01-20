@extends('layouts.admin')

@section('title', 'Users')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Users</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage application users and their roles.</div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">New user</a>
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
                <th style="padding:0.5rem 0.25rem;">Email</th>
                <th style="padding:0.5rem 0.25rem;">Roles</th>
                <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:0.5rem 0.25rem;">{{ $user->name }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $user->email }}</td>
                    <td style="padding:0.5rem 0.25rem;">
                        {{ $user->getRoleNames()->implode(', ') ?: '—' }}
                    </td>
                    <td style="padding:0.5rem 0.25rem; text-align:right;">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                        No users found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:0.75rem;">
            {{ $users->links() }}
        </div>
    </div>
@endsection


