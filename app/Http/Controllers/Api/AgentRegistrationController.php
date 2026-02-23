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
            'birth_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'nid_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'photo_up' => 'nullable|array|max:2',
            'photo_up.*' => 'file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'chairman_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'husbands_information' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'considerable_person_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'bank_check' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'trade_license' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'digital_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Initialize data with non-file fields
        $data = $request->except([
            'birth_certificate',
            'nid_file',
            'photo_up',
            'chairman_certificate',
            'husbands_information',
            'considerable_person_sign',
            'bank_check',
            'trade_license',
            'digital_sign'
        ]);

        // Handle single file uploads
        $singleFiles = [
            'birth_certificate',
            'nid_file',
            'chairman_certificate',
            'husbands_information',
            'considerable_person_sign',
            'bank_check',
            'trade_license',
            'digital_sign',
        ];

        foreach ($singleFiles as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('agent_registrations', 'public');
            }
        }

        // Handle multiple photo uploads
        if ($request->hasFile('photo_up')) {
            $photos = [];
            $files = $request->file('photo_up');

            // Ensure we're dealing with an array of files
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                $photos[] = $file->store('agent_registrations', 'public');
            }
            $data['photo_up'] = $photos;
        }

        $registration = AgentRegistration::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Agent registration submitted successfully.',
            'data' => $registration
        ], 201);
    }
}
