<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OurInitial;
use Illuminate\Http\JsonResponse;

class OurInitialController extends Controller
{
    public function index(): JsonResponse
    {
        $data = OurInitial::latest()->get();
        return response()->json($data);
    }
}
