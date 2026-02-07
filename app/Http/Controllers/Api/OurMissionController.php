<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OurMission;
use Illuminate\Http\JsonResponse;

class OurMissionController extends Controller
{
    public function index(): JsonResponse
    {
        $data = OurMission::latest()->get();
        return response()->json($data);
    }
}
