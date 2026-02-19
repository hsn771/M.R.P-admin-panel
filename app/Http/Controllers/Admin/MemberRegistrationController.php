<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberRegistration;
use Illuminate\Http\Request;

class MemberRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = MemberRegistration::query();

        if ($request->filled('search_id')) {
            $query->where('id', $request->search_id);
        }

        if ($request->filled('search_name')) {
            $query->where('name', 'like', '%' . $request->search_name . '%');
        }

        $memberRegistrations = $query->oldest()->paginate(10);
        return view('admin.member_registrations.index', compact('memberRegistrations'));
    }

    public function create()
    {
        return view('admin.member_registrations.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,avif',
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

        MemberRegistration::create($input);

        return redirect()->route('admin.member-registrations.index')
            ->with('success', 'Member Registration created successfully.');
    }

    public function show(MemberRegistration $memberRegistration)
    {
        if (request()->has('print')) {
            return view('admin.member_registrations.print', compact('memberRegistration'));
        }
        return view('admin.member_registrations.show', compact('memberRegistration'));
    }

    public function edit(MemberRegistration $memberRegistration)
    {
        return view('admin.member_registrations.edit', compact('memberRegistration'));
    }

    public function update(Request $request, MemberRegistration $memberRegistration)
    {
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,avif',
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

        if ($request->hasFile('image')) {
            // Delete old image
            if ($memberRegistration->image && file_exists(public_path('storage/' . $memberRegistration->image))) {
                unlink(public_path('storage/' . $memberRegistration->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/member-registrations');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $input['image'] = 'member-registrations/' . $imageName;
        } else {
            unset($input['image']);
        }

        if ($request->hasFile('digital_sign')) {
            $input['digital_sign'] = $request->file('digital_sign')->store('member-registrations', 'public');
        } else {
            unset($input['digital_sign']);
        }

        $memberRegistration->update($input);

        return redirect()->route('admin.member-registrations.index')
            ->with('success', 'Member Registration updated successfully');
    }

    public function viewFile($filename)
    {
        $path = storage_path('app/public/member-registrations/' . $filename);

        // Fallback to public path if storage path fails (handles manual moves)
        if (!file_exists($path)) {
            $path = public_path('storage/member-registrations/' . $filename);
        }

        if (!file_exists($path)) {
            abort(404);
        }

        if (request()->has('download')) {
            return response()->download($path);
        }

        return response()->file($path);
    }

    public function destroy(MemberRegistration $memberRegistration)
    {
        if ($memberRegistration->image && file_exists(public_path('storage/' . $memberRegistration->image))) {
            unlink(public_path('storage/' . $memberRegistration->image));
        }
        $memberRegistration->delete();

        return redirect()->route('admin.member-registrations.index')
            ->with('success', 'Member Registration deleted successfully');
    }
}
