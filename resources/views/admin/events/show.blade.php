@extends('layouts.admin')

@section('title', 'Event Details')

@section('header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="font-size: 1.1rem; font-weight: 600;">Event Details</h1>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-primary btn-sm">Edit Event</a>
            <a href="{{ route('admin.events.index') }}" class="btn btn-outline btn-sm">Back to List</a>
        </div>
    </div>
@endsection

@section('content')
    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 1.5rem;">
        <!-- Main Content -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- basic Info -->
            <div class="card">
                <div style="margin-bottom: 1.5rem;">
                    <span
                        style="background: #e0f2fe; color: #0369a1; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                        {{ $event->type_name ?? 'General Event' }}
                    </span>
                    <h2 style="font-size: 1.5rem; font-weight: 700; margin-top: 0.5rem; color: #111827;">{{ $event->title }}
                    </h2>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.025em; font-weight: 600;">Date</label>
                        <p style="font-weight: 500; color: #1f2937;">{{ $event->date->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.025em; font-weight: 600;">Time</label>
                        <p style="font-weight: 500; color: #1f2937;">{{ $event->time ?? 'Not Specified' }}</p>
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label
                        style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.025em; font-weight: 600;">Address</label>
                    <p style="font-weight: 500; color: #1f2937;">{{ $event->address ?? 'No address provided' }}</p>
                </div>

                <div>
                    <label
                        style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.025em; font-weight: 600; margin-bottom: 0.5rem;">Description</label>
                    <div style="color: #374151; line-height: 1.6; white-space: pre-line;">
                        {{ $event->description }}
                    </div>
                </div>
            </div>

            <!-- Program Schedule -->
            @if($event->schedule && count($event->schedule) > 0)
                <div class="card">
                    <h3
                        style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem; border-bottom: 1px solid #f3f4f6; padding-bottom: 0.5rem;">
                        Program Schedule</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        @foreach($event->schedule as $item)
                            <div
                                style="display: flex; gap: 1rem; align-items: flex-start; padding: 0.5rem; border-radius: 0.4rem; background: #f9fafb;">
                                <div style="min-width: 100px; font-weight: 600; color: #059669; font-size: 0.85rem;">
                                    {{ $item['time'] }}
                                </div>
                                <div style="color: #1f2937; font-size: 0.85rem;">
                                    {{ $item['subject'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Reasons / Highlights -->
            @if($event->reasons && count($event->reasons) > 0)
                <div class="card">
                    <h3
                        style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem; border-bottom: 1px solid #f3f4f6; padding-bottom: 0.5rem;">
                        Reasons / Highlights</h3>
                    <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 0.5rem;">
                        @foreach($event->reasons as $reason)
                            @if($reason)
                                <li style="display: flex; align-items: center; gap: 0.75rem; color: #374151; font-size: 0.85rem;">
                                    <span
                                        style="display: inline-block; width: 6px; height: 6px; background: #2563eb; border-radius: 50%;"></span>
                                    {{ $reason }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Sidebar (Images) -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Main Image -->
            <div class="card" style="padding: 0.5rem;">
                <label
                    style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.025em; font-weight: 600; margin: 0.5rem;">Main
                    Poster</label>
                @if($event->image)
                    <img src="{{ asset($event->image) }}" alt="Main Image"
                        style="width: 100%; border-radius: 0.4rem; border: 1px solid #f3f4f6;">
                @else
                    <div
                        style="width: 100%; aspect-ratio: 4/5; background: #f3f4f6; border-radius: 0.4rem; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 0.85rem;">
                        No poster uploaded
                    </div>
                @endif
            </div>

            <!-- Photo Gallery -->
            @if($event->image_gallery && count($event->image_gallery) > 0)
                <div class="card" style="padding: 0.5rem;">
                    <label
                        style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.025em; font-weight: 600; margin: 0.5rem;">Photo
                        Gallery</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; padding: 0.5rem;">
                        @foreach($event->image_gallery as $image)
                            <a href="{{ asset($image) }}" target="_blank">
                                <img src="{{ asset($image) }}" alt="Gallery Item"
                                    style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 0.4rem; border: 1px solid #f3f4f6; transition: opacity 0.2s;"
                                    onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection