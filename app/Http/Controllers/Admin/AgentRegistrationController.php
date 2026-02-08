<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentRegistration;
use Illuminate\Http\Request;

class AgentRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = AgentRegistration::query();

        if ($request->filled('search_id')) {
            $query->where('id', $request->search_id);
        }

        if ($request->filled('search_name')) {
            $query->where('full_name', 'like', '%' . $request->search_name . '%');
        }

        $agentRegistrations = $query->oldest()->get();
        return view('admin.agent_registrations.index', compact('agentRegistrations'));
    }

    public function create()
    {
        return view('admin.agent_registrations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|in:retail,wholesale,online,other',
            'time_of_business' => 'required|string|max:255',
            'address' => 'required|string',
            'district' => 'required|string|max:255',
            'nid_no' => 'nullable|string|max:255',
            'description' => 'required|string',
            'birth_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'nid_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'photo_up' => 'nullable|array|max:2',
            'photo_up.*' => 'file|mimes:jpeg,png,jpg,pdf',
            'chairman_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'husbands_information' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'considerable_person_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'bank_check' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'trade_license' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'digital_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
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
                $input[$field] = $request->file($field)->store('agent_registrations', 'public');
            }
        }

        if ($request->hasFile('photo_up')) {
            $photos = [];
            foreach ($request->file('photo_up') as $file) {
                $photos[] = $file->store('agent_registrations', 'public');
            }
            $input['photo_up'] = $photos;
        }

        AgentRegistration::create($input);

        return redirect()->route('admin.agent-registrations.index')
            ->with('success', 'Agent Registration created successfully.');
    }

    public function show(AgentRegistration $agentRegistration)
    {
        if (request()->has('print')) {
            return view('admin.agent_registrations.print', compact('agentRegistration'));
        }
        return view('admin.agent_registrations.show', compact('agentRegistration'));
    }

    public function edit(AgentRegistration $agentRegistration)
    {
        return view('admin.agent_registrations.edit', compact('agentRegistration'));
    }

    public function update(Request $request, AgentRegistration $agentRegistration)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|in:retail,wholesale,online,other',
            'time_of_business' => 'required|string|max:255',
            'address' => 'required|string',
            'district' => 'required|string|max:255',
            'nid_no' => 'nullable|string|max:255',
            'description' => 'required|string',
            'birth_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'nid_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'photo_up' => 'nullable|array|max:2',
            'photo_up.*' => 'file|mimes:jpeg,png,jpg,pdf',
            'chairman_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'husbands_information' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'considerable_person_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'bank_check' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'trade_license' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'digital_sign' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
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
                $input[$field] = $request->file($field)->store('agent_registrations', 'public');
            } else {
                // Keep the old file if no new file is uploaded
                unset($input[$field]);
            }
        }

        if ($request->hasFile('photo_up')) {
            $photos = [];
            foreach ($request->file('photo_up') as $file) {
                $photos[] = $file->store('agent_registrations', 'public');
            }
            $input['photo_up'] = $photos;
        } else {
            unset($input['photo_up']);
        }

        $agentRegistration->update($input);

        return redirect()->route('admin.agent-registrations.index')
            ->with('success', 'Agent Registration updated successfully');
    }

    public function viewFile($filename)
    {
        $path = storage_path('app/public/agent_registrations/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        if (request()->has('download')) {
            return response()->download($path);
        }

        return response()->file($path);
    }

    public function destroy(AgentRegistration $agentRegistration)
    {
        $agentRegistration->delete();

        return redirect()->route('admin.agent-registrations.index')
            ->with('success', 'Agent Registration deleted successfully');
    }
}
