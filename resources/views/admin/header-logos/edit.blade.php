@extends('layouts.admin')

@section('title', 'Edit Settings')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit Settings</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.header-logos.update') }}" enctype="multipart/form-data" style="max-width:800px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom:1.5rem;">
                <h2 style="font-size:0.95rem; font-weight:600; margin-bottom:0.75rem; color:#374151;">Basic Information</h2>
                
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem; margin-bottom:0.75rem;">
                    <div>
                        <label for="name_eng" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Name (English)</label>
                        <input id="name_eng" name="name_eng" type="text" value="{{ old('name_eng', $setting->name_eng ?? '') }}" required
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        @error('name_eng')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="name_bn" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Name (Bengali)</label>
                        <input id="name_bn" name="name_bn" type="text" value="{{ old('name_bn', $setting->name_bn ?? '') }}" required
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        @error('name_bn')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem; margin-bottom:0.75rem;">
                    <div>
                        <label for="email" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $setting->email ?? '') }}" required
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        @error('email')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Phone</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone', $setting->phone ?? '') }}" required
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        @error('phone')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="margin-bottom:0.75rem;">
                    <label for="address" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Address</label>
                    <textarea id="address" name="address" rows="2" required
                              style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db; resize:vertical;">{{ old('address', $setting->address ?? '') }}</textarea>
                    @error('address')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom:1.5rem;">
                <h2 style="font-size:0.95rem; font-weight:600; margin-bottom:0.75rem; color:#374151;">Social Media Links</h2>
                
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem;">
                    <div>
                        <label for="facebook" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Facebook</label>
                        <input id="facebook" name="facebook" type="text" value="{{ old('facebook', $setting->facebook ?? '') }}"
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        @error('facebook')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="twitter" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Twitter</label>
                        <input id="twitter" name="twitter" type="text" value="{{ old('twitter', $setting->twitter ?? '') }}"
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        @error('twitter')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="instagram" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Instagram</label>
                        <input id="instagram" name="instagram" type="text" value="{{ old('instagram', $setting->instagram ?? '') }}"
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        @error('instagram')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="linkedin" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">LinkedIn</label>
                        <input id="linkedin" name="linkedin" type="text" value="{{ old('linkedin', $setting->linkedin ?? '') }}"
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        @error('linkedin')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="youtube" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">YouTube</label>
                        <input id="youtube" name="youtube" type="text" value="{{ old('youtube', $setting->youtube ?? '') }}"
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        @error('youtube')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div style="margin-bottom:1.5rem;">
                <h2 style="font-size:0.95rem; font-weight:600; margin-bottom:0.75rem; color:#374151;">Logos</h2>
                
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem;">
                    <div>
                        <label for="logo_header" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Header Logo</label>
                        @if($setting && $setting->logo_header)
                            <div style="margin-bottom:0.5rem;">
                                <img src="{{ asset('storage/' . $setting->logo_header) }}" alt="Current header logo" 
                                     style="max-width:200px; max-height:100px; object-fit:contain; border-radius:0.25rem; border:1px solid #d1d5db;">
                            </div>
                        @endif
                        <input id="logo_header" name="logo_header" type="file" accept="image/*"
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        <div class="muted" style="margin-top:0.25rem; font-size:0.75rem;">
                            Accepted formats: JPEG, PNG, JPG, GIF, WEBP, SVG. Max size: 2MB
                        </div>
                        @error('logo_header')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="logo_footer" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Footer Logo</label>
                        @if($setting && $setting->logo_footer)
                            <div style="margin-bottom:0.5rem;">
                                <img src="{{ asset('storage/' . $setting->logo_footer) }}" alt="Current footer logo" 
                                     style="max-width:200px; max-height:100px; object-fit:contain; border-radius:0.25rem; border:1px solid #d1d5db;">
                            </div>
                        @endif
                        <input id="logo_footer" name="logo_footer" type="file" accept="image/*"
                               style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        <div class="muted" style="margin-top:0.25rem; font-size:0.75rem;">
                            Accepted formats: JPEG, PNG, JPG, GIF, WEBP, SVG. Max size: 2MB
                        </div>
                        @error('logo_footer')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div style="margin-bottom:1.5rem;">
                <h2 style="font-size:0.95rem; font-weight:600; margin-bottom:0.75rem; color:#374151;">Contact Page</h2>
                
                <div style="margin-bottom:0.75rem;">
                    <label for="contact_page_title" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Contact Page Title</label>
                    <input id="contact_page_title" name="contact_page_title" type="text" value="{{ old('contact_page_title', $setting->contact_page_title ?? '') }}" required
                           style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                    @error('contact_page_title')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom:0.75rem;">
                    <label for="contact_page_subtitle" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Contact Page Subtitle</label>
                    <input id="contact_page_subtitle" name="contact_page_subtitle" type="text" value="{{ old('contact_page_subtitle', $setting->contact_page_subtitle ?? '') }}" required
                           style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                    @error('contact_page_subtitle')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom:0.75rem;">
                    <label for="contact_page_description" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Contact Page Description</label>
                    <textarea id="contact_page_description" name="contact_page_description" rows="4" required
                              style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db; resize:vertical;">{{ old('contact_page_description', $setting->contact_page_description ?? '') }}</textarea>
                    @error('contact_page_description')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom:0.75rem;">
                    <label for="footer_description" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Footer Description</label>
                    <textarea id="footer_description" name="footer_description" rows="4"
                              style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db; resize:vertical;">{{ old('footer_description', $setting->footer_description ?? '') }}</textarea>
                    @error('footer_description')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Save Settings</button>
                <a href="{{ route('admin.header-logos.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection
