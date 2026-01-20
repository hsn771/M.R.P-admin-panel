@extends('layouts.admin')

@section('title', 'Create mission')

@section('header')
    <h1 style="font-size: 1.1rem; font-weight: 600;">Create mission</h1>
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.missions.store') }}" style="max-width:600px;">
            @csrf

            <div style="margin-bottom:0.75rem;">
                <label for="title" style="display:block; font-size:0.85rem; margin-bottom:0.25rem;">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required
                       style="width:100%; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                @error('title')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:0.75rem;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.5rem;">
                    <label style="display:block; font-size:0.85rem;">Subjects</label>
                    <button type="button" onclick="addSubjectField()" class="btn btn-outline" style="font-size:0.8rem; padding:0.3rem 0.6rem;">
                        + Add Subject
                    </button>
                </div>
                <div id="subjects-container">
                    <div class="subject-field" style="display:flex; gap:0.5rem; margin-bottom:0.5rem; align-items:flex-start;">
                        <input type="text" name="subjects[]" placeholder="Enter subject" required
                               style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                        <button type="button" onclick="removeSubjectField(this)" class="btn btn-outline" 
                                style="color:#b91c1c; border-color:#b91c1c; padding:0.45rem 0.75rem; font-size:0.8rem;">
                            Remove
                        </button>
                    </div>
                </div>
                <div class="muted" style="margin-top:0.25rem; font-size:0.75rem;">
                    Click "Add Subject" to add more subjects. Each subject will be displayed as a bullet point.
                </div>
                @error('subject')
                <div style="color:#b91c1c; font-size:0.8rem; margin-top:0.2rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top:1rem; display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('admin.missions.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        function addSubjectField() {
            const container = document.getElementById('subjects-container');
            const newField = document.createElement('div');
            newField.className = 'subject-field';
            newField.style.cssText = 'display:flex; gap:0.5rem; margin-bottom:0.5rem; align-items:flex-start;';
            newField.innerHTML = `
                <input type="text" name="subjects[]" placeholder="Enter subject" required
                       style="flex:1; padding:0.45rem 0.6rem; border-radius:0.4rem; border:1px solid #d1d5db;">
                <button type="button" onclick="removeSubjectField(this)" class="btn btn-outline" 
                        style="color:#b91c1c; border-color:#b91c1c; padding:0.45rem 0.75rem; font-size:0.8rem;">
                    Remove
                </button>
            `;
            container.appendChild(newField);
        }

        function removeSubjectField(button) {
            const container = document.getElementById('subjects-container');
            if (container.children.length > 1) {
                button.closest('.subject-field').remove();
            } else {
                alert('At least one subject is required.');
            }
        }
    </script>
@endsection
