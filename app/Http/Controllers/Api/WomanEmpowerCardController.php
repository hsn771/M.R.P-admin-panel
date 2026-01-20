<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WomanEmpowerCard;
use App\Models\WomanEmpowerFormImage;
use Illuminate\Http\JsonResponse;

class WomanEmpowerCardController extends Controller
{
    /**
     * Get all woman empower cards for the frontend
     */
    public function index(): JsonResponse
    {
        $cards = WomanEmpowerCard::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($card) {
                return [
                    'id' => $card->id,
                    'name' => $card->name,
                    'age' => $card->age,
                    'husband_father_name' => $card->husband_father_name,
                    'mother_name' => $card->mother_name,
                    'address' => $card->address,
                    'voter_id' => $card->voter_id,
                    'created_at' => $card->created_at->toISOString(),
                    'updated_at' => $card->updated_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $cards,
        ]);
    }

    /**
     * Get the form image for the frontend
     */
    public function getFormImage(): JsonResponse
    {
        $formImage = WomanEmpowerFormImage::latest()->first();

        return response()->json([
            'success' => true,
            'data' => $formImage ? [
                'id' => $formImage->id,
                'image' => $formImage->image ? asset('storage/' . $formImage->image) : null,
                'created_at' => $formImage->created_at->toISOString(),
            ] : null,
        ]);
    }
}
