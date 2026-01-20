<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;

class SliderController extends Controller
{
    /**
     * Get all sliders for the frontend
     */
    public function index(): JsonResponse
    {
        $sliders = Slider::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($slider) {
                return [
                    'id' => $slider->id,
                    'image' => $slider->image_url,
                    'created_at' => $slider->created_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $sliders,
        ]);
    }
}