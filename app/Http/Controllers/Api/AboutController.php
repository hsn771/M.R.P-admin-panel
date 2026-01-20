<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\JsonResponse;

class AboutController extends Controller
{
    /**
     * Get all abouts for the frontend
     */
    public function index(): JsonResponse
    {
        $abouts = About::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($about) {
                return [
                    'id' => $about->id,
                    'title' => $about->title,
                    'description' => $about->description,
                    'created_at' => $about->created_at->toISOString(),
                    'updated_at' => $about->updated_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $abouts,
        ]);
    }
}
