<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobApplicationController extends Controller
{
    /**
     * Store a newly created job application.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_no' => 'required|string|max:255',
            'apply_for_post' => 'required|string|max:255',
            'work_experience' => 'nullable|string',
            'educational_qualifications' => 'required|string',
            'cover_letter' => 'required|string',
            'cv_upload' => 'required|file|mimes:pdf,doc,docx',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Initialize data with non-file fields
        $data = $request->except(['cv_upload']);

        // Handle CV file upload
        if ($request->hasFile('cv_upload')) {
            $data['cv_upload'] = $request->file('cv_upload')->store('job_applications/cvs', 'public');
        }

        $jobApplication = JobApplication::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Your job application has been submitted successfully.',
            'data' => $jobApplication
        ], 201);
    }
}
