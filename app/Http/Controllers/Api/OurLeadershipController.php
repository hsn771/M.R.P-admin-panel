<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OurLeadership;
use Illuminate\Http\JsonResponse;

class OurLeadershipController extends Controller
{
    public function index(): JsonResponse
    {
        $data = OurLeadership::latest()->get();
        return response()->json($data);
    }
}
