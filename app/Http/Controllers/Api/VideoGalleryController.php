<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\JsonResponse;

class VideoGalleryController extends Controller
{
    /**
     * Get all video gallery videos for the frontend
     */
    public function index(): JsonResponse
    {
        $videoGalleries = VideoGallery::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($videoGallery) {
                return [
                    'id' => $videoGallery->id,
                    'video' => $videoGallery->video_url,
                    'created_at' => $videoGallery->created_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $videoGalleries,
        ]);
    }
}