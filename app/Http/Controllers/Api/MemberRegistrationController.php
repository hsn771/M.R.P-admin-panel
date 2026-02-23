<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MemberRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberRegistrationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,gif,webp,svg,avif',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'family_member_num' => 'required|integer',
            'nid_no' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'merital_status' => 'required|string|max:255',
            'village_permanent' => 'required|string|max:255',
            'post_name_permanent' => 'required|string|max:255',
            'thana_upozilla_permanent' => 'required|string|max:255',
            'block_permanent' => 'required|string|max:255',
            'district_permanent' => 'required|string|max:255',
            'post_code_permanent' => 'required|string|max:255',
            'road_present' => 'required|string|max:255',
            'post_name_present' => 'required|string|max:255',
            'thana_upozilla_present' => 'required|string|max:255',
            'block_present' => 'required|string|max:255',
            'district_present' => 'required|string|max:255',
            'post_code_present' => 'required|string|max:255',
            'sponsor_name' => 'required|string|max:255',
            'sponsor_phone' => 'required|string|max:255',
            'digital_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $input = $request->except(['image', 'digital_sign']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/member-registrations');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $input['image'] = 'member-registrations/' . $imageName;
        }

        if ($request->hasFile('digital_sign')) {
            $input['digital_sign'] = $request->file('digital_sign')->store('member-registrations', 'public');
        }

        $registration = MemberRegistration::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Member registration successful.',
            'data' => $registration
        ], 201);
    }
}
