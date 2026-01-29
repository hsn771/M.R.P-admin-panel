<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\JsonResponse;

class VacancyController extends Controller
{
    public function index(): JsonResponse
    {
        $vacancies = Vacancy::latest()->get();
        return response()->json([
            'status' => true,
            'data' => $vacancies
        ]);
    }
}
