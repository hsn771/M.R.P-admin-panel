<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubAgentRegistration;
use Illuminate\Http\Request;

class SubAgentRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = SubAgentRegistration::query();

        if ($request->filled('search_id')) {
            $query->where('id', $request->search_id);
        }

        if ($request->filled('search_name')) {
            $query->where('full_name', 'like', '%' . $request->search_name . '%');
        }

        $subAgentRegistrations = $query->oldest()->get();
        return view('admin.sub_agent_registrations.index', compact('subAgentRegistrations'));
    }

    public function create()
    {
        return view('admin.sub_agent_registrations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'district' => 'required|string|max:255',
            'nid_no' => 'nullable|string|max:255',
            'description' => 'required|string',
            'birth_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'nid_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'photo_up' => 'nullable|array|max:2',
            'photo_up.*' => 'file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'chairman_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'husbands_information' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'considerable_person_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'bank_check' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'trade_license' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'digital_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
        ]);

        $input = $request->all();

        $fileFields = [
            'birth_certificate',
            'nid_file',
            'chairman_certificate',
            'husbands_information',
            'considerable_person_sign',
            'bank_check',
            'trade_license',
            'digital_sign',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $input[$field] = $request->file($field)->store('sub_agent_registrations', 'public');
            }
        }

        if ($request->hasFile('photo_up')) {
            $photos = [];
            foreach ($request->file('photo_up') as $file) {
                $photos[] = $file->store('sub_agent_registrations', 'public');
            }
            $input['photo_up'] = $photos;
        }

        SubAgentRegistration::create($input);

        return redirect()->route('admin.sub-agent-registrations.index')
            ->with('success', 'Sub Agent Registration created successfully.');
    }

    public function show(SubAgentRegistration $subAgentRegistration)
    {
        if (request()->has('print')) {
            return view('admin.sub_agent_registrations.print', compact('subAgentRegistration'));
        }
        return view('admin.sub_agent_registrations.show', compact('subAgentRegistration'));
    }

    public function edit(SubAgentRegistration $subAgentRegistration)
    {
        return view('admin.sub_agent_registrations.edit', compact('subAgentRegistration'));
    }

    public function update(Request $request, SubAgentRegistration $subAgentRegistration)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'district' => 'required|string|max:255',
            'nid_no' => 'nullable|string|max:255',
            'description' => 'required|string',
            'birth_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'nid_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'photo_up' => 'nullable|array|max:2',
            'photo_up.*' => 'file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'chairman_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'husbands_information' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'considerable_person_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'bank_check' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'trade_license' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
            'digital_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf,webp,svg,avif',
        ]);

        $input = $request->all();

        $fileFields = [
            'birth_certificate',
            'nid_file',
            'chairman_certificate',
            'husbands_information',
            'considerable_person_sign',
            'bank_check',
            'trade_license',
            'digital_sign',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $input[$field] = $request->file($field)->store('sub_agent_registrations', 'public');
            } else {
                unset($input[$field]);
            }
        }

        if ($request->hasFile('photo_up')) {
            $photos = [];
            foreach ($request->file('photo_up') as $file) {
                $photos[] = $file->store('sub_agent_registrations', 'public');
            }
            $input['photo_up'] = $photos;
        } else {
            unset($input['photo_up']);
        }

        $subAgentRegistration->update($input);

        return redirect()->route('admin.sub-agent-registrations.index')
            ->with('success', 'Sub Agent Registration updated successfully');
    }

    public function viewFile($filename)
    {
        $path = storage_path('app/public/sub_agent_registrations/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        if (request()->has('download')) {
            return response()->download($path);
        }

        return response()->file($path);
    }

    public function destroy(SubAgentRegistration $subAgentRegistration)
    {
        $subAgentRegistration->delete();

        return redirect()->route('admin.sub-agent-registrations.index')
            ->with('success', 'Sub Agent Registration deleted successfully');
    }
}
