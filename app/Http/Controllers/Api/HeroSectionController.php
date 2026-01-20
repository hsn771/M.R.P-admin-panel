<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\JsonResponse;

class HeroSectionController extends Controller
{
    /**
     * Get all hero sections for the frontend
     */
    public function index(): JsonResponse
    {
        $heroSections = HeroSection::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($heroSection) {
                return [
                    'id' => $heroSection->id,
                    'name' => $heroSection->name,
                    'image' => $heroSection->image ? asset('storage/' . $heroSection->image) : null,
                    'description' => $heroSection->description,
                    'created_at' => $heroSection->created_at->toISOString(),
                    'updated_at' => $heroSection->updated_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $heroSections,
        ]);
    }
}