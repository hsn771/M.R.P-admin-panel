<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EventRegistrationController extends Controller
{
    public function index(): View
    {
        $registrations = EventRegistration::latest()->paginate(10);
        return view('admin.event-registrations.index', compact('registrations'));
    }

    public function show(EventRegistration $eventRegistration): View
    {
        return view('admin.event-registrations.show', ['registration' => $eventRegistration]);
    }

    public function destroy(EventRegistration $eventRegistration): RedirectResponse
    {
        $eventRegistration->delete();
        return redirect()->route('admin.event-registrations.index')->with('status', 'Registration deleted successfully!');
    }
}
