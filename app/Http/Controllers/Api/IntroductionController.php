<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Introduction;
use Illuminate\Http\JsonResponse;

class IntroductionController extends Controller
{
    /**
     * Get all introductions for the frontend
     */
    public function index(): JsonResponse
    {
        $introductions = Introduction::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($introduction) {
                return [
                    'id' => $introduction->id,
                    'title' => $introduction->title,
                    'description' => $introduction->description,
                    'created_at' => $introduction->created_at->toISOString(),
                    'updated_at' => $introduction->updated_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $introductions,
        ]);
    }
}
