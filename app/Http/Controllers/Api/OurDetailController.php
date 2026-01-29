<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OurDetail;
use Illuminate\Http\JsonResponse;

class OurDetailController extends Controller
{
    public function index(): JsonResponse
    {
        $ourDetails = OurDetail::all();
        return response()->json([
            'status' => true,
            'data' => $ourDetails
        ]);
    }
}
