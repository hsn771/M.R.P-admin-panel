<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PhotoGallery;
use Illuminate\Http\JsonResponse;

class PhotoGalleryController extends Controller
{
    /**
     * Get all photo gallery images for the frontend
     */
    public function index()
    {
        $photoGalleries = PhotoGallery::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($photoGallery) {
                return [
                    'id' => $photoGallery->id,
                    'image' => $photoGallery->image_url,
                    'created_at' => $photoGallery->created_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $photoGalleries,
        ]);
    }
}