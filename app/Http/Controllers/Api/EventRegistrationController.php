<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'gender' => 'required|string|max:20',
            'post' => 'required|string|max:255',
            'additional_info' => 'nullable|string',
        ]);

        $registration = \App\Models\EventRegistration::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Registration submitted successfully!',
            'data' => $registration
        ], 201);
    }
}
