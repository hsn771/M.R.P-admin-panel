<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::orderBy('date', 'desc')->paginate(15);

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function show(Event $event): View
    {
        return view('admin.events.show', compact('event'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,avif'],
            'type_name' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'time' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'description' => ['required', 'string'],
            'reasons' => ['nullable', 'array'],
            'schedule_time' => ['nullable', 'array'],
            'schedule_subject' => ['nullable', 'array'],
            'gallery_images.*' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,avif'],
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/events'), $imageName);
            $data['image'] = 'uploads/events/' . $imageName;
        }

        // Process gallery
        $gallery = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $name = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('uploads/events/gallery'), $name);
                $gallery[] = 'uploads/events/gallery/' . $name;
            }
        }
        $data['image_gallery'] = $gallery;

        // Process schedule
        $schedule = [];
        if ($request->has('schedule_time')) {
            foreach ($request->schedule_time as $index => $time) {
                if ($time || $request->schedule_subject[$index]) {
                    $schedule[] = [
                        'time' => $time,
                        'subject' => $request->schedule_subject[$index] ?? '',
                    ];
                }
            }
        }
        $data['schedule'] = $schedule;

        Event::create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Event created successfully.');
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,avif'],
            'type_name' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'time' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'description' => ['required', 'string'],
            'reasons' => ['nullable', 'array'],
            'schedule_time' => ['nullable', 'array'],
            'schedule_subject' => ['nullable', 'array'],
            'gallery_images.*' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,avif'],
            'remove_gallery_images' => ['nullable', 'array'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image && file_exists(public_path($event->image))) {
                unlink(public_path($event->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/events'), $imageName);
            $data['image'] = 'uploads/events/' . $imageName;
        }

        // Process gallery
        $gallery = $event->image_gallery ?? [];
        
        // Remove selected images
        if ($request->has('remove_gallery_images')) {
            foreach ($request->remove_gallery_images as $imagePath) {
                if (file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }
                if (($key = array_search($imagePath, $gallery)) !== false) {
                    unset($gallery[$key]);
                }
            }
            $gallery = array_values($gallery); // re-index
        }

        // Add new images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $name = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('uploads/events/gallery'), $name);
                $gallery[] = 'uploads/events/gallery/' . $name;
            }
        }
        $data['image_gallery'] = $gallery;

        // Process schedule
        $schedule = [];
        if ($request->has('schedule_time')) {
            foreach ($request->schedule_time as $index => $time) {
                if ($time || $request->schedule_subject[$index]) {
                    $schedule[] = [
                        'time' => $time,
                        'subject' => $request->schedule_subject[$index] ?? '',
                    ];
                }
            }
        }
        $data['schedule'] = $schedule;

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        if ($event->image && file_exists(public_path($event->image))) {
            unlink(public_path($event->image));
        }

        if ($event->image_gallery) {
            foreach ($event->image_gallery as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Event deleted successfully.');
    }
}
