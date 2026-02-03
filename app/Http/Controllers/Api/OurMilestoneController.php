<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OurMilestone;
use Illuminate\Http\JsonResponse;

class OurMilestoneController extends Controller
{
    public function index(): JsonResponse
    {
        $data = OurMilestone::latest()->get();
        return response()->json($data);
    }
}
