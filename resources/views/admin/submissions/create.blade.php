@extends('layouts.admin')

@section('title', 'Create Submission')

@section('content')

<h2 class="text-xl font-bold mb-4">Create Submission</h2>

<form method="POST" action="{{ route('admin.submissions.store') }}" class="bg-white p-4 shadow">
    @csrf

    <!-- Form Select -->
    <div class="mb-4">
        <label class="block mb-1">Select Form</label>
        <select name="form_id" id="form_id" class="w-full border p-2">
            <option value="">-- Select Form --</option>
            @foreach($forms as $form)
                <option value="{{ $form->id }}">{{ $form->title }}</option>
            @endforeach
        </select>
    </div>

    <!-- Dynamic Fields -->
    <div id="dynamic-fields"></div>

    <button class="bg-green-500 text-white px-4 py-2 rounded mt-4">
        Save
    </button>
</form>
<script>
document.getElementById('form_id').addEventListener('change', function () {
    let formId = this.value;

    if (!formId) {
        document.getElementById('dynamic-fields').innerHTML = '';
        return;
    }

    fetch(`/admin/forms/${formId}/fields`)
        .then(res => res.json())
        .then(fields => {
            let html = '';

            fields.forEach(field => {

                // ✅ FIX: ensure valid field name
                let fieldId = field.id;
                let fieldName = (field.name || field.label || field.id)
                    .toString()
                    .toLowerCase()
                    .replace(/\s+/g, '_');

                html += `<div class="mb-3">`;
                html += `<label class="block mb-1">${field.label}</label>`;

                // TEXT
                if (field.type === 'text') {
                    html += `<input type="text" name="data[${fieldId}]" class="w-full border p-2">`;
                }

                // TEXTAREA
                else if (field.type === 'textarea') {
                    html += `<textarea name="data[${fieldId}]" class="w-full border p-2"></textarea>`;
                }

                // SELECT
                else if (field.type === 'select') {
                    html += `<select name="data[${fieldId}]" class="w-full border p-2">`;

                    if (field.options) {
                        field.options.forEach(opt => {
                            html += `<option value="${opt}">${opt}</option>`;
                        });
                    }

                    html += `</select>`;
                }

                // RADIO
                else if (field.type === 'radio') {
                    if (field.options) {
                        field.options.forEach(opt => {
                            html += `
                                <label class="mr-2">
                                    <input type="radio" name="data[${fieldId}]" value="${opt}"> ${opt}
                                </label>
                            `;
                        });
                    }
                }

                // CHECKBOX
                else if (field.type === 'checkbox') {
                    if (field.options) {
                        field.options.forEach(opt => {
                            html += `
                                <label class="mr-2">
                                    <input type="checkbox" name="data[${fieldId}][]" value="${opt}"> ${opt}
                                </label>
                            `;
                        });
                    }
                }

                html += `</div>`;
            });

            document.getElementById('dynamic-fields').innerHTML = html;
        })
        .catch(err => {
            console.error('Error loading fields:', err);
        });
});
</script>
@endsection