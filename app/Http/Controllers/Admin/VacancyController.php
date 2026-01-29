<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VacancyController extends Controller
{
    public function index(): View
    {
        $vacancies = Vacancy::latest()->paginate(15);
        return view('admin.vacancies.index', compact('vacancies'));
    }

    public function create(): View
    {
        return view('admin.vacancies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'workplace' => 'required|string|max:255',
            'worktime' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'description' => 'required|string',
            'skills' => 'required|array',
            'skills.*' => 'required|string|max:255',
            'last_date_of_apply' => 'required|date',
        ]);

        Vacancy::create($data);

        return redirect()->route('admin.vacancies.index')
            ->with('status', 'Vacancy created successfully.');
    }

    public function edit(Vacancy $vacancy): View
    {
        return view('admin.vacancies.edit', compact('vacancy'));
    }

    public function update(Request $request, Vacancy $vacancy): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'workplace' => 'required|string|max:255',
            'worktime' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'description' => 'required|string',
            'skills' => 'required|array',
            'skills.*' => 'required|string|max:255',
            'last_date_of_apply' => 'required|date',
        ]);

        $vacancy->update($data);

        return redirect()->route('admin.vacancies.index')
            ->with('status', 'Vacancy updated successfully.');
    }

    public function destroy(Vacancy $vacancy): RedirectResponse
    {
        $vacancy->delete();

        return redirect()->route('admin.vacancies.index')
            ->with('status', 'Vacancy deleted successfully.');
    }
}
