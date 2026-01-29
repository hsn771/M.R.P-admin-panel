@extends('layouts.admin')

@section('title', 'Create Vacancy')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Create Vacancy</h1>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('admin.vacancies.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 1rem;">
                <label for="title" style="display:block; font-weight:500; margin-bottom:0.5rem;">Title</label>
                <input type="text" name="title" id="title"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('title') }}" required>
                @error('title') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="workplace" style="display:block; font-weight:500; margin-bottom:0.5rem;">Workplace
                    (Address)</label>
                <input type="text" name="workplace" id="workplace"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('workplace') }}" required>
                @error('workplace') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="worktime" style="display:block; font-weight:500; margin-bottom:0.5rem;">Worktime</label>
                <input type="text" name="worktime" id="worktime"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('worktime') }}" placeholder="e.g 9am - 5pm or Full Time" required>
                @error('worktime') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="experience" style="display:block; font-weight:500; margin-bottom:0.5rem;">Experience</label>
                <input type="text" name="experience" id="experience"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('experience') }}" required>
                @error('experience') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="description" style="display:block; font-weight:500; margin-bottom:0.5rem;">Description</label>
                <textarea name="description" id="description" rows="5"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    required>{{ old('description') }}</textarea>
                @error('description') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="display:block; font-weight:500; margin-bottom:0.5rem;">Skills</label>
                <div id="skills-container">
                    <div class="skill-input" style="display:flex; margin-bottom:0.5rem;">
                        <input type="text" name="skills[]"
                            style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db; margin-right:0.5rem;"
                            placeholder="Enter skill" required>
                    </div>
                </div>
                <button type="button" id="add-skill" class="btn btn-outline" style="font-size:0.8rem;"><i
                        class="fa-solid fa-plus"></i> Add Another Skill</button>
                @error('skills') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="last_date_of_apply" style="display:block; font-weight:500; margin-bottom:0.5rem;">Last Date of
                    Apply</label>
                <input type="date" name="last_date_of_apply" id="last_date_of_apply"
                    style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;"
                    value="{{ old('last_date_of_apply') }}" required>
                @error('last_date_of_apply') <div style="color:red; font-size:0.875rem;">{{ $message }}</div> @enderror
            </div>

            <div style="text-align: right;">
                <a href="{{ route('admin.vacancies.index') }}" class="btn btn-outline"
                    style="margin-right:0.5rem;">Cancel</a>
                <button type="submit" class="btn btn-primary" style="background:#2563eb; color:white;">Create</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-skill').addEventListener('click', function () {
            const container = document.getElementById('skills-container');
            const div = document.createElement('div');
            div.className = 'skill-input';
            div.style.cssText = 'display:flex; margin-bottom:0.5rem;';
            div.innerHTML = `
                <input type="text" name="skills[]" style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db; margin-right:0.5rem;" placeholder="Enter skill" required>
                <button type="button" class="btn btn-outline remove-skill" style="color:red; border-color:red;"><i class="fa-solid fa-trash"></i></button>
            `;
            container.appendChild(div);
        });

        document.getElementById('skills-container').addEventListener('click', function (e) {
            if (e.target.closest('.remove-skill')) {
                e.target.closest('.skill-input').remove();
            }
        });
    </script>
@endsection