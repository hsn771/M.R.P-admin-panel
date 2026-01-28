@extends('layouts.admin')

@section('title', 'Agent Registrations')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Agent Registrations</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage agent registrations.</div>
            <div style="display:flex; gap:0.5rem; align-items:center;">
                <form action="{{ route('admin.agent-registrations.index') }}" method="GET"
                    style="display:flex; gap:0.5rem; align-items:center;">
                    <input type="text" name="search_id" placeholder="Search by ID" value="{{ request('search_id') }}"
                        style="padding:0.4rem 0.75rem; border:1px solid #e5e7eb; border-radius:0.375rem; font-size:0.875rem;">
                    <input type="text" name="search_name" placeholder="Search by Name" value="{{ request('search_name') }}"
                        style="padding:0.4rem 0.75rem; border:1px solid #e5e7eb; border-radius:0.375rem; font-size:0.875rem;">
                    <button type="submit" class="btn btn-primary" style="padding: 0.45rem 1rem;">
                        <i class="fa-solid fa-magnifying-glass" style="margin-right: 0.4rem;"></i> Search
                    </button>
                    @if(request('search_id') || request('search_name'))
                        <a href="{{ route('admin.agent-registrations.index') }}" class="btn btn-outline"
                            style="padding: 0.45rem 1rem;">
                            <i class="fa-solid fa-rotate-left" style="margin-right: 0.4rem;"></i> Clear
                        </a>
                    @endif
                </form>
                <a href="{{ route('admin.agent-registrations.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus" style="margin-right: 0.4rem;"></i> Add New
                </a>
            </div>
        </div>

        @if (session('success'))
            <div
                style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('success') }}
            </div>
        @endif

        <table style="width:100%; border-collapse:collapse; font-size:0.9rem;">
            <thead>
                <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:0.5rem 0.25rem;">ID</th>
                    <th style="padding:0.5rem 0.25rem;">Full Name</th>
                    <th style="padding:0.5rem 0.25rem;">Mobile No</th>
                    <th style="padding:0.5rem 0.25rem;">Email</th>
                    <th style="padding:0.5rem 0.25rem;">Business Name</th>
                    <th style="padding:0.5rem 0.25rem;">Business Type</th>
                    <th style="padding:0.5rem 0.25rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($agentRegistrations as $registration)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:0.5rem 0.25rem;">{{ $registration->id }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $registration->full_name }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $registration->mobile_no }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $registration->email }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ $registration->business_name }}</td>
                        <td style="padding:0.5rem 0.25rem;">{{ ucfirst($registration->business_type) }}</td>
                        <td style="padding:0.5rem 0.25rem; text-align:right;">
                            <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                                <button type="button"
                                    onclick="openPrintModal('{{ route('admin.agent-registrations.show', $registration) }}?print=1')"
                                    class="btn btn-outline" style="color:#059669; border-color:#059669;">
                                    <i class="fa-solid fa-print"></i>
                                </button>
                                <a href="{{ route('admin.agent-registrations.show', $registration) }}" class="btn btn-outline">
                                    <i class="fa-solid fa-eye" style="margin-right: 0.3rem;"></i>
                                </a>
                                <a href="{{ route('admin.agent-registrations.edit', $registration) }}" class="btn btn-outline">
                                    <i class="fa-solid fa-pen-to-square" style="margin-right: 0.3rem;"></i>
                                </a>
                                <form action="{{ route('admin.agent-registrations.destroy', $registration) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline" style="color:#b91c1c; border-color:#b91c1c;"
                                        onclick="return confirm('Are you sure you want to delete this?')">
                                        <i class="fa-solid fa-trash" style="margin-right: 0.3rem;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:0.75rem 0.25rem; text-align:center; color:#6b7280;">
                            No agent registrations found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- Print Modal -->
    <div id="printModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="font-size: 1.1rem; font-weight: 600; color: #111827;">Print Preview</h2>
                <span class="close-modal" onclick="closePrintModal()">&times;</span>
            </div>
            <div class="modal-body">
                <iframe id="printFrame" style="width:100%; height:100%; border:none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closePrintModal()">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="printNow()">
                    <i class="fa-solid fa-print" style="margin-right: 0.5rem;"></i> Print Now
                </button>
            </div>
        </div>
    </div>

    <script>
        function openPrintModal(url) {
            const modal = document.getElementById('printModal');
            const iframe = document.getElementById('printFrame');
            iframe.src = url;
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closePrintModal() {
            const modal = document.getElementById('printModal');
            const iframe = document.getElementById('printFrame');
            modal.style.display = 'none';
            iframe.src = '';
            document.body.style.overflow = 'auto';
        }

        function printNow() {
            const iframe = document.getElementById('printFrame');
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        }

        // Close modal if clicked outside
        window.onclick = function (event) {
            const modal = document.getElementById('printModal');
            if (event.target == modal) {
                closePrintModal();
            }
        }
    </script>
@endsection