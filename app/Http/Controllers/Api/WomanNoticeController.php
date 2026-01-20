<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WomanNotice;
use Illuminate\Http\JsonResponse;

class WomanNoticeController extends Controller
{
    /**
     * Get all woman notices for the frontend
     */
    public function index(): JsonResponse
    {
        $womanNotices = WomanNotice::orderBy('date', 'desc')
            ->get()
            ->map(function ($womanNotice) {
                return [
                    'id' => $womanNotice->id,
                    'title' => $womanNotice->title,
                    'description' => $womanNotice->description,
                    'date' => $womanNotice->date->format('Y-m-d'),
                    'created_at' => $womanNotice->created_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $womanNotices,
        ]);
    }
}
