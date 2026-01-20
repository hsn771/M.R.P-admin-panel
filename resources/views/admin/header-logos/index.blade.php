@extends('layouts.admin')

@section('title', 'Settings')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Settings</h1>
@endsection

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <div class="muted">Manage website settings and logos.</div>
            @if($setting)
                <a href="{{ route('admin.header-logos.edit') }}" class="btn btn-primary">Edit Settings</a>
            @else
                <a href="{{ route('admin.header-logos.edit') }}" class="btn btn-primary">Create Settings</a>
            @endif
        </div>

        @if (session('status'))
            <div style="padding:0.5rem 0.75rem; border-radius:0.5rem; background:#ecfdf5; color:#166534; font-size:0.85rem; margin-bottom:0.75rem;">
                {{ session('status') }}
            </div>
        @endif

        @if($setting)
            <div style="display:grid; gap:1rem;">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Name (English)</div>
                        <div style="font-size:0.9rem; font-weight:500;">{{ $setting->name_eng }}</div>
                    </div>
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Name (Bengali)</div>
                        <div style="font-size:0.9rem; font-weight:500;">{{ $setting->name_bn }}</div>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Email</div>
                        <div style="font-size:0.9rem;">{{ $setting->email }}</div>
                    </div>
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Phone</div>
                        <div style="font-size:0.9rem;">{{ $setting->phone }}</div>
                    </div>
                </div>

                <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                    <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Address</div>
                    <div style="font-size:0.9rem;">{{ $setting->address }}</div>
                </div>

                <div style="display:grid; grid-template-columns:repeat(5, 1fr); gap:1rem;">
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Facebook</div>
                        <div style="font-size:0.9rem;">{{ $setting->facebook ?: '—' }}</div>
                    </div>
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Twitter</div>
                        <div style="font-size:0.9rem;">{{ $setting->twitter ?: '—' }}</div>
                    </div>
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Instagram</div>
                        <div style="font-size:0.9rem;">{{ $setting->instagram ?: '—' }}</div>
                    </div>
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">LinkedIn</div>
                        <div style="font-size:0.9rem;">{{ $setting->linkedin ?: '—' }}</div>
                    </div>
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">YouTube</div>
                        <div style="font-size:0.9rem;">{{ $setting->youtube ?: '—' }}</div>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.5rem;">Header Logo</div>
                        @if($setting->logo_header)
                            <img src="{{ asset('storage/' . $setting->logo_header) }}" alt="Header logo" 
                                 style="max-width:200px; max-height:100px; object-fit:contain; border-radius:0.25rem;">
                        @else
                            <span class="muted">No logo</span>
                        @endif
                    </div>
                    <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                        <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.5rem;">Footer Logo</div>
                        @if($setting->logo_footer)
                            <img src="{{ asset('storage/' . $setting->logo_footer) }}" alt="Footer logo" 
                                 style="max-width:200px; max-height:100px; object-fit:contain; border-radius:0.25rem;">
                        @else
                            <span class="muted">No logo</span>
                        @endif
                    </div>
                </div>

                <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                    <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Contact Page Title</div>
                    <div style="font-size:0.9rem; font-weight:500;">{{ $setting->contact_page_title }}</div>
                </div>

                <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                    <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Contact Page Subtitle</div>
                    <div style="font-size:0.9rem; font-weight:500;">{{ $setting->contact_page_subtitle }}</div>
                </div>

                <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                    <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Contact Page Description</div>
                    <div style="font-size:0.9rem; white-space:pre-wrap;">{{ $setting->contact_page_description }}</div>
                </div>

                <div style="padding:0.75rem; background:#f9fafb; border-radius:0.5rem; border:1px solid #e5e7eb;">
                    <div style="font-size:0.75rem; color:#6b7280; margin-bottom:0.25rem;">Footer Description</div>
                    <div style="font-size:0.9rem; white-space:pre-wrap;">{{ $setting->footer_description ?: '—' }}</div>
                </div>
            </div>
        @else
            <div style="padding:2rem; text-align:center; color:#6b7280;">
                <p>No settings found. Click "Create Settings" to get started.</p>
            </div>
        @endif
    </div>
@endsection
