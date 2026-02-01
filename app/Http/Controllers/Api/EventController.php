<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    /**
     * Get all events for the frontend
     */
    public function index(): JsonResponse
    {
        $events = Event::orderBy('date', 'desc')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'image' => $event->image ? asset($event->image) : null,
                    'type_name' => $event->type_name,
                    'title' => $event->title,
                    'address' => $event->address,
                    'time' => $event->time,
                    'date' => $event->date->format('Y-m-d'),
                    'description' => $event->description,
                    'reasons' => $event->reasons ?? [],
                    'schedule' => $event->schedule ?? [],
                    'image_gallery' => $event->image_gallery ? array_map(fn($img) => asset($img), $event->image_gallery) : [],
                    'created_at' => $event->created_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Events retrieved successfully',
            'data' => $events,
        ]);
    }
}
