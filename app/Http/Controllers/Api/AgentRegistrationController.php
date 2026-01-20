<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentRegistrationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|in:retail,wholesale,online,other',
            'time_of_business' => 'required|string|max:255',
            'address' => 'required|string',
            'district' => 'required|string|max:255',
            'nid_no' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $registration = AgentRegistration::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Agent registration submitted successfully.',
            'data' => $registration
        ], 201);
    }
}
