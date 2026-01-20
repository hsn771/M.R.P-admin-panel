<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\JsonResponse;

class MissionController extends Controller
{
    /**
     * Get all missions for the frontend
     */
    public function index(): JsonResponse
    {
        $missions = Mission::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($mission) {
                // Split subject by newlines and filter empty lines
                $subjects = array_filter(array_map('trim', explode("\n", $mission->subject)));
                
                return [
                    'id' => $mission->id,
                    'title' => $mission->title,
                    'subject' => $mission->subject,
                    'subjects' => array_values($subjects), // Return as array for easier frontend use
                    'created_at' => $mission->created_at->toISOString(),
                    'updated_at' => $mission->updated_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $missions,
        ]);
    }
}
