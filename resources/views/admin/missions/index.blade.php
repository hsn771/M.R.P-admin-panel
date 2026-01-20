@extends('layouts.admin')

@section('title', 'Missions')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Missions</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage mission statements and their subjects.</div>
            <a href="{{ route('admin.missions.create') }}" class="btn btn-primary">New mission</a>
        </div>

        @if (session('status'))
            <div style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('status') }}
            </div>
        @endif

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
            <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                <th style="padding:0.5rem 0.25rem;">ID</th>
                <th style="padding:0.5rem 0.25rem;">Title</th>
                <th style="padding:0.5rem 0.25rem;">Subjects</th>
                <th style="padding:0.5rem 0.25rem;">Created</th>
                <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($missions as $mission)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:0.5rem 0.25rem;">{{ $mission->id }}</td>
                    <td style="padding:0.5rem 0.25rem;">{{ $mission->title }}</td>
                    <td style="padding:0.5rem 0.25rem;">
                        @php
                            $subjects = array_filter(explode("\n", $mission->subject));
                        @endphp
                        @if(count($subjects) > 0)
                            <ul style="margin:0; padding-left:1.25rem; list-style-type:disc;">
                                @foreach(array_slice($subjects, 0, 3) as $subject)
                                    <li style="font-size:0.85rem; margin-bottom:0.25rem;">{{ trim($subject) }}</li>
                                @endforeach
                                @if(count($subjects) > 3)
                                    <li style="font-size:0.85rem; color:#6b7280;">+ {{ count($subjects) - 3 }} more</li>
                                @endif
                            </ul>
                        @else
                            <span class="muted">No subjects</span>
                        @endif
                    </td>
                    <td style="padding:0.5rem 0.25rem;">{{ $mission->created_at->format('M d, Y') }}</td>
                    <td style="padding:0.5rem 0.25rem; text-align:right;">
                        <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                            <a href="{{ route('admin.missions.edit', $mission) }}" class="btn btn-outline">Edit</a>
                            <form action="{{ route('admin.missions.destroy', $mission) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" 
                                        style="color:#b91c1c; border-color:#b91c1c;"
                                        onclick="return confirm('Are you sure you want to delete this mission?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                        No missions found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:0.75rem;">
            {{ $missions->links() }}
        </div>
    </div>
@endsection
