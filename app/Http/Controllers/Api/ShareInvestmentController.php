<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShareInvestment;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ShareInvestmentController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'member_id' => 'nullable|string|max:255',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nominee_name' => 'required|string|max:255',
            'nominee_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'investment_category' => 'required|in:' . implode(',', array_keys(ShareInvestment::CATEGORIES)),
            'investment_duration' => 'required|string|max:255',
            'investment_amount' => 'required|numeric|min:1',
            'investment_amount_in_words' => 'required|string|max:255',
            'sponsor_name' => 'nullable|string|max:255',
            'sponsor_id_mobile' => 'nullable|string|max:255',
            'digital_sign' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ];

        foreach (ShareInvestment::ADDRESS_PREFIXES as $prefix) {
            foreach (array_keys(ShareInvestment::ADDRESS_FIELDS) as $field) {
                $rules["{$prefix}_{$field}"] = 'nullable|string|max:255';
            }
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $input = $validator->validated();

        foreach (['customer_photo', 'nominee_photo', 'digital_sign'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $input[$fileField] = $this->storeFile($request->file($fileField));
            }
        }

        $investment = ShareInvestment::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Share investment application submitted successfully.',
            'data' => [
                'id' => $investment->id,
                'application_no' => $investment->application_no,
            ],
        ], 201);
    }

    private function storeFile(UploadedFile $file): string
    {
        $name = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

        return $file->storeAs('share-investments', $name, 'public');
    }
}
