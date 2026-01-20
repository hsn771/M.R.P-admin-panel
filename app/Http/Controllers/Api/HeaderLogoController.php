<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class HeaderLogoController extends Controller
{
    /**
     * Get settings for the frontend
     */
    public function index(): JsonResponse
    {
        $setting = Setting::first();

        if (!$setting) {
            return response()->json([
                'success' => true,
                'data' => null,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $setting->id,
                'name_eng' => $setting->name_eng,
                'name_bn' => $setting->name_bn,
                'email' => $setting->email,
                'phone' => $setting->phone,
                'address' => $setting->address,
                'facebook' => $setting->facebook,
                'twitter' => $setting->twitter,
                'instagram' => $setting->instagram,
                'linkedin' => $setting->linkedin,
                'youtube' => $setting->youtube,
                'logo_header' => $setting->logo_header ? asset('storage/' . $setting->logo_header) : null,
                'logo_footer' => $setting->logo_footer ? asset('storage/' . $setting->logo_footer) : null,
                'contact_page_title' => $setting->contact_page_title,
                'contact_page_description' => $setting->contact_page_description,
                'contact_page_subtitle' => $setting->contact_page_subtitle,
                'footer_description' => $setting->footer_description,
                'created_at' => $setting->created_at->toISOString(),
                'updated_at' => $setting->updated_at->toISOString(),
            ],
        ]);
    }
}