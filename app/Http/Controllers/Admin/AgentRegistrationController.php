<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentRegistration;
use Illuminate\Http\Request;

class AgentRegistrationController extends Controller
{
    public function index()
    {
        $agentRegistrations = AgentRegistration::latest()->get();
        return view('admin.agent_registrations.index', compact('agentRegistrations'));
    }

    public function create()
    {
        return view('admin.agent_registrations.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
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
        ]);

        AgentRegistration::create($input);

        return redirect()->route('admin.agent-registrations.index')
            ->with('success', 'Agent Registration created successfully.');
    }

    public function show(AgentRegistration $agentRegistration)
    {
        return view('admin.agent_registrations.show', compact('agentRegistration'));
    }

    public function edit(AgentRegistration $agentRegistration)
    {
        return view('admin.agent_registrations.edit', compact('agentRegistration'));
    }

    public function update(Request $request, AgentRegistration $agentRegistration)
    {
        $input = $request->validate([
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
        ]);

        $agentRegistration->update($input);

        return redirect()->route('admin.agent-registrations.index')
            ->with('success', 'Agent Registration updated successfully');
    }

    public function destroy(AgentRegistration $agentRegistration)
    {
        $agentRegistration->delete();

        return redirect()->route('admin.agent-registrations.index')
            ->with('success', 'Agent Registration deleted successfully');
    }
}
