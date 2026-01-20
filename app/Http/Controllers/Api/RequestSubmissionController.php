<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RequestSubmission;
use App\Models\RequestFormImage;
use Illuminate\Http\JsonResponse;

class RequestSubmissionController extends Controller
{
    /**
     * Get all request submissions for the frontend
     */
    public function index(): JsonResponse
    {
        $submissions = RequestSubmission::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($submission) {
                return [
                    'id' => $submission->id,
                    'name' => $submission->name,
                    'subject' => $submission->subject,
                    'address' => $submission->address,
                    'email' => $submission->email,
                    'mobile_number' => $submission->mobile_number,
                    'voter_id_card_number' => $submission->voter_id_card_number,
                    'detailed_description' => $submission->detailed_description,
                    'status' => $submission->status ?? 'চলমান',
                    'created_at' => $submission->created_at->toISOString(),
                    'updated_at' => $submission->updated_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $submissions,
        ]);
    }

    /**
     * Get the form image for the frontend
     */
    public function getFormImage(): JsonResponse
    {
        $formImage = RequestFormImage::latest()->first();

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
