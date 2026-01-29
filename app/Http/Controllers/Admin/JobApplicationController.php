<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of job applications.
     */
    public function index()
    {
        $jobApplications = JobApplication::latest()->get();
        return view('admin.job-applications.index', compact('jobApplications'));
    }

    /**
     * Display the specified job application.
     */
    public function show(JobApplication $jobApplication)
    {
        return view('admin.job-applications.show', compact('jobApplication'));
    }

    /**
     * Remove the specified job application from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        // Delete the CV file if it exists
        if ($jobApplication->cv_upload && \Storage::disk('public')->exists($jobApplication->cv_upload)) {
            \Storage::disk('public')->delete($jobApplication->cv_upload);
        }

        $jobApplication->delete();

        return redirect()->route('admin.job-applications.index')
            ->with('success', 'Job application deleted successfully');
    }
}
