<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubAgentRegistration;
use Illuminate\Http\Request;

class SubAgentRegistrationController extends Controller
{
    public function index()
    {
        $subAgentRegistrations = SubAgentRegistration::latest()->get();
        return view('admin.sub_agent_registrations.index', compact('subAgentRegistrations'));
    }

    public function create()
    {
        return view('admin.sub_agent_registrations.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'district' => 'required|string|max:255',
            'nid_no' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        SubAgentRegistration::create($input);

        return redirect()->route('admin.sub-agent-registrations.index')
            ->with('success', 'Sub Agent Registration created successfully.');
    }

    public function show(SubAgentRegistration $subAgentRegistration)
    {
        return view('admin.sub_agent_registrations.show', compact('subAgentRegistration'));
    }

    public function edit(SubAgentRegistration $subAgentRegistration)
    {
        return view('admin.sub_agent_registrations.edit', compact('subAgentRegistration'));
    }

    public function update(Request $request, SubAgentRegistration $subAgentRegistration)
    {
        $input = $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'district' => 'required|string|max:255',
            'nid_no' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        $subAgentRegistration->update($input);

        return redirect()->route('admin.sub-agent-registrations.index')
            ->with('success', 'Sub Agent Registration updated successfully');
    }

    public function destroy(SubAgentRegistration $subAgentRegistration)
    {
        $subAgentRegistration->delete();

        return redirect()->route('admin.sub-agent-registrations.index')
            ->with('success', 'Sub Agent Registration deleted successfully');
    }
}
