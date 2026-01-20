<?php

namespace App\Http\Controllers;

use App\Models\WomanEmpowerCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WomanEmpowerCardController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'date'],
            'husband_father_name' => ['required', 'string', 'max:255'],
            'mother_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'voter_id' => ['required', 'string', 'max:255'],
        ]);

        $card = WomanEmpowerCard::create($data);

        return response()->json([
            'success' => true,
            'message' => 'আপনার তথ্য সফলভাবে জমা দেওয়া হয়েছে।',
            'data' => $card,
        ], 201);
    }
}
