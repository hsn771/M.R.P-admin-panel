@extends('layouts.admin')

@section('title', 'Edit Event')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Edit Event</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div style="margin-bottom:0.75rem;">
                    <label for="image" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Main Image</label>
                    <input id="image" name="image" type="file"
                        style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                    @if($event->image)
                        <div style="margin-top:0.5rem;">
                            <img src="{{ asset($event->image) }}" alt="Preview" style="max-height:100px; border-radius:0.4rem;">
                        </div>
                    @endif
                    @error('image')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom:0.75rem;">
                    <label for="type_name" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Type Name (e.g.
                        Workshop, Seminar)</label>
                    <input id="type_name" name="type_name" type="text" value="{{ old('type_name', $event->type_name) }}"
                        style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                    @error('type_name')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="title" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title', $event->title) }}" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('title')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="address" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Address</label>
                <input id="address" name="address" type="text" value="{{ old('address', $event->address) }}"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('address')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div style="margin-bottom:0.75rem;">
                    <label for="time" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">General Time (e.g.
                        10:00 AM - 05:00 PM)</label>
                    <input id="time" name="time" type="text" value="{{ old('time', $event->time) }}"
                        style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                    @error('time')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom:0.75rem;">
                    <label for="date" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Date</label>
                    <input id="date" name="date" type="date"
                        value="{{ old('date', $event->date ? $event->date->format('Y-m-d') : '') }}" required
                        style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                    @error('date')
                        <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom:0.75rem;">
                <label for="description"
                    style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Description</label>
                <textarea id="description" name="description" rows="3" required
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db; resize:vertical;">{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <hr style="margin: 1.5rem 0; border: 0; border-top: 1px solid #eee;">

            <!-- Image Gallery Section -->
            <div style="margin-bottom:1.5rem;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.5rem;">
                    <label style="display:block; font-size:0.9rem; font-weight:600;">Image Gallery</label>
                    <button type="button" id="add-gallery" class="btn btn-sm btn-outline"
                        style="padding: 0.2rem 0.5rem; font-size: 0.75rem;">+ Add New</button>
                </div>

                @if($event->image_gallery)
                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                        @foreach($event->image_gallery as $image)
                            <div style="position: relative; border: 1px solid #eee; border-radius: 0.4rem; padding: 0.25rem;">
                                <img src="{{ asset($image) }}" alt="Gallery"
                                    style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 0.2rem;">
                                <div
                                    style="margin-top: 0.25rem; font-size: 0.7rem; color: #dc2626; display: flex; align-items: center; gap: 0.25rem;">
                                    <input type="checkbox" name="remove_gallery_images[]" value="{{ $image }}"
                                        id="remove-{{ $loop->index }}">
                                    <label for="remove-{{ $loop->index }}">Remove</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div id="gallery-container">
                    <!-- New images will be added here -->
                </div>
            </div>

            <hr style="margin: 1.5rem 0; border: 0; border-top: 1px solid #eee;">

            <!-- Reasons Section -->
            <div style="margin-bottom:1.5rem;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.5rem;">
                    <label style="display:block; font-size:0.9rem; font-weight:600;">Reasons / Highlights</label>
                    <button type="button" id="add-reason" class="btn btn-sm btn-outline"
                        style="padding: 0.2rem 0.5rem; font-size: 0.75rem;">+ Add New</button>
                </div>
                <div id="reasons-container">
                    @php $reasons = old('reasons', $event->reasons ?? []); @endphp
                    @forelse($reasons as $reason)
                        <div class="reason-item" style="display:flex; gap:0.5rem; margin-bottom:0.5rem;">
                            <input name="reasons[]" type="text" value="{{ $reason }}" placeholder="Enter reason..."
                                style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                            <button type="button" class="remove-item btn btn-sm btn-outline-danger"
                                style="padding: 0.2rem 0.5rem; color: #dc2626; border-color: #fecaca;">&times;</button>
                        </div>
                    @empty
                        <div class="reason-item" style="display:flex; gap:0.5rem; margin-bottom:0.5rem;">
                            <input name="reasons[]" type="text" placeholder="Enter reason..."
                                style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                            <button type="button" class="remove-item btn btn-sm btn-outline-danger"
                                style="padding: 0.2rem 0.5rem; color: #dc2626; border-color: #fecaca;">&times;</button>
                        </div>
                    @endforelse
                </div>
            </div>

            <hr style="margin: 1.5rem 0; border: 0; border-top: 1px solid #eee;">

            <!-- Schedule Section -->
            <div style="margin-bottom:1.5rem;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.5rem;">
                    <label style="display:block; font-size:0.9rem; font-weight:600;">Program Schedule (Time &
                        Subject)</label>
                    <button type="button" id="add-schedule" class="btn btn-sm btn-outline"
                        style="padding: 0.2rem 0.5rem; font-size: 0.75rem;">+ Add New</button>
                </div>
                <div id="schedule-container">
                    @php $schedule = old('schedule_time', $event->schedule ?? []); @endphp
                    @forelse($schedule as $item)
                        <div class="schedule-item" style="display:flex; gap:0.5rem; margin-bottom:0.5rem;">
                            <input name="schedule_time[]" type="text" value="{{ $item['time'] ?? '' }}"
                                placeholder="Time (e.g. 10:00 AM)"
                                style="width:150px; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                            <input name="schedule_subject[]" type="text" value="{{ $item['subject'] ?? '' }}"
                                placeholder="Subject"
                                style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                            <button type="button" class="remove-item btn btn-sm btn-outline-danger"
                                style="padding: 0.2rem 0.5rem; color: #dc2626; border-color: #fecaca;">&times;</button>
                        </div>
                    @empty
                        <div class="schedule-item" style="display:flex; gap:0.5rem; margin-bottom:0.5rem;">
                            <input name="schedule_time[]" type="text" placeholder="Time (e.g. 10:00 AM)"
                                style="width:150px; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                            <input name="schedule_subject[]" type="text" placeholder="Subject"
                                style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                            <button type="button" class="remove-item btn btn-sm btn-outline-danger"
                                style="padding: 0.2rem 0.5rem; color: #dc2626; border-color: #fecaca;">&times;</button>
                        </div>
                    @endforelse
                </div>
            </div>

            <div style="margin-top:2rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Update Event</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add Gallery Image
            document.getElementById('add-gallery').addEventListener('click', function () {
                const container = document.getElementById('gallery-container');
                const newItem = document.createElement('div');
                newItem.className = 'gallery-item';
                newItem.style = 'display:flex; gap:0.5rem; margin-bottom:0.5rem;';
                newItem.innerHTML = `
                        <input name="gallery_images[]" type="file"
                               style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        <button type="button" class="remove-item btn btn-sm btn-outline-danger" style="padding: 0.2rem 0.5rem; color: #dc2626; border-color: #fecaca;">&times;</button>
                    `;
                container.appendChild(newItem);
            });

            // Add Reason
            document.getElementById('add-reason').addEventListener('click', function () {
                const container = document.getElementById('reasons-container');
                const newItem = document.createElement('div');
                newItem.className = 'reason-item';
                newItem.style = 'display:flex; gap:0.5rem; margin-bottom:0.5rem;';
                newItem.innerHTML = `
                            <input name="reasons[]" type="text" placeholder="Enter reason..."
                                   style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                            <button type="button" class="remove-item btn btn-sm btn-outline-danger" style="padding: 0.2rem 0.5rem; color: #dc2626; border-color: #fecaca;">&times;</button>
                        `;
                container.appendChild(newItem);
            });

            // Add Schedule
            document.getElementById('add-schedule').addEventListener('click', function () {
                const container = document.getElementById('schedule-container');
                const newItem = document.createElement('div');
                newItem.className = 'schedule-item';
                newItem.style = 'display:flex; gap:0.5rem; margin-bottom:0.5rem;';
                newItem.innerHTML = `
                            <input name="schedule_time[]" type="text" placeholder="Time (e.g. 10:00 AM)"
                                   style="width:150px; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                            <input name="schedule_subject[]" type="text" placeholder="Subject"
                                   style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                            <button type="button" class="remove-item btn btn-sm btn-outline-danger" style="padding: 0.2rem 0.5rem; color: #dc2626; border-color: #fecaca;">&times;</button>
                        `;
                container.appendChild(newItem);
            });

            // Remove Item (Event Delegation)
            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-item')) {
                    const items = e.target.closest('.reason-item') || e.target.closest('.schedule-item') || e.target.closest('.gallery-item');
                    if (items) {
                        items.remove();
                    }
                }
            });
        });
    </script>
@endsection