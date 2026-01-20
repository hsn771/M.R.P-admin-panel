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
                    'title' => $event->title,
                    'date' => $event->date->format('Y-m-d'),
                    'description' => $event->description,
                    'created_at' => $event->created_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $events,
        ]);
    }
}
