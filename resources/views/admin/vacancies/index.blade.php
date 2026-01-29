@extends('layouts.admin')

@section('title', 'Vacancies')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Vacancies</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage job vacancies.</div>
            <a href="{{ route('admin.vacancies.create') }}" class="btn btn-primary"
                style="background: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem;">
                <i class="fa-solid fa-plus" style="margin-right: 0.5rem;"></i> Add New
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
                    <th style="padding:0.5rem 0.25rem;">Title</th>
                    <th style="padding:0.5rem 0.25rem;">Workplace</th>
                    <th style="padding:0.5rem 0.25rem;">Worktime</th>
                    <th style="padding:0.5rem 0.25rem;">Deadline</th>
                    <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vacancies as $vacancy)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:0.5rem 0.25rem;">{{ $vacancy->title }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $vacancy->workplace }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $vacancy->worktime }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $vacancy->last_date_of_apply->format('d M, Y') }}</td>
                        <td style="padding:0.5rem 0.25rem; text-align:right;">
                            <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                                <a href="{{ route('admin.vacancies.edit', $vacancy) }}" class="btn btn-outline"
                                    style="color: #2563eb;">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.vacancies.destroy', $vacancy) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline" style="color:#b91c1c;"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:1rem;">No vacancies found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 1rem;">
            {{ $vacancies->links() }}
        </div>
    </div>
@endsection