@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('header')
    <h1 style="font-size: 1.25rem; font-weight: 600; color: #111827;">Dashboard</h1>
@endsection

@section('content')
    <div class="card">
        <h2 style="font-size: 1.05rem; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            Welcome, {{ auth()->user()->name ?? auth()->user()->email }}
        </h2>
        <p class="muted" style="margin-bottom: 0.75rem;">
            You are logged in to the Laravel admin panel.
        </p>

        <div style="margin-top: 1rem; font-size: 0.9rem;">
            <strong>Account details</strong>
            <ul style="margin-top: 0.4rem; padding-left: 1.1rem; color: #374151;">
                <li>Email: {{ auth()->user()->email }}</li>
                <li>Roles: {{ auth()->user()->getRoleNames()->implode(', ') ?: 'none' }}</li>
            </ul>
        </div>
    </div>
@endsection


