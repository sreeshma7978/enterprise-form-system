@section('title', 'Create Form')

@section('content')

<form method="POST" action="{{ route('admin.forms.store') }}" onsubmit="return handleSubmit()">
    @csrf

    <!-- Title -->
    <div class="mb-4">
        <label class="block mb-1">Form Title</label>
        <input type="text" name="title" class="border p-2 w-full" required>
    </div>

    <!-- Fields -->
    <div id="fields-container"></div>

    <!-- Add Field -->
    <button type="button" onclick="addField()" class="bg-green-500 text-white px-3 py-1 mb-4">
        + Add Field
    </button>

    <!-- Hidden -->
    <input type="hidden" name="fields" id="fieldsInput">

    <!-- Submit -->
    <button class="bg-blue-500 text-white px-4 py-2">Save Form</button>
</form>

<script>
let fields = [];

function addField() {
    fields.push({
        id: Date.now(),
        label: '',
        name: '',
        type: 'text',
        required: false,
        options: []
    });

    render();
}

function render() {
    let html = '';

    fields.forEach((field, index) => {

        html += `
        <div class="border p-4 mb-3 bg-white">

            <input placeholder="Label"
                class="border p-2 w-full mb-2"
                value="${field.label}"
                oninput="updateField(${index}, 'label', this.value)">

            <input placeholder="Name"
                class="border p-2 w-full mb-2"
                value="${field.name}"
                oninput="updateField(${index}, 'name', this.value)">

            <select class="border p-2 w-full mb-2"
                onchange="updateField(${index}, 'type', this.value)">

                <option value="text" ${field.type=='text'?'selected':''}>Text</option>
                <option value="email" ${field.type=='email'?'selected':''}>Email</option>
                <option value="number" ${field.type=='number'?'selected':''}>Number</option>
                <option value="dropdown" ${field.type=='dropdown'?'selected':''}>Dropdown</option>
                <option value="checkbox" ${field.type=='checkbox'?'selected':''}>Checkbox</option>
            </select>

            <label>
                <input type="checkbox"
                    ${field.required ? 'checked' : ''}
                    onchange="updateField(${index}, 'required', this.checked)">
                Required
            </label>
        `;

        if (field.type === 'dropdown' || field.type === 'checkbox') {

            html += `<div class="mt-3"><b>Options:</b></div>`;

            field.options.forEach((opt, optIndex) => {
                html += `
                <div class="flex mb-2">
                    <input class="border p-2 flex-1"
                        value="${opt}"
                        oninput="updateOption(${index}, ${optIndex}, this.value)">

                    <button type="button"
                        onclick="removeOption(${index}, ${optIndex})"
                        class="bg-red-500 text-white px-2 ml-2">
                        X
                    </button>
                </div>
                `;
            });

            html += `
                <button type="button"
                    onclick="addOption(${index})"
                    class="bg-green-500 text-white px-2 py-1">
                    + Add Option
                </button>
            `;
        }

        html += `
            <br><br>

            <button type="button"
                onclick="removeField(${index})"
                class="bg-red-500 text-white px-2 py-1">
                Remove Field
            </button>

        </div>
        `;
    });

    document.getElementById('fields-container').innerHTML = html;

    document.getElementById('fieldsInput').value = JSON.stringify(fields);
}

function updateField(index, key, value) {
    fields[index][key] = value;

    // auto name
    if (key === 'label') {
        fields[index].name = value.toLowerCase().replace(/\s+/g, '_');
    }

    render();
}

function addOption(index) {
    fields[index].options.push('');
    render();
}

function updateOption(index, optIndex, value) {
    fields[index].options[optIndex] = value;
}

function removeOption(index, optIndex) {
    fields[index].options.splice(optIndex, 1);
    render();
}

function removeField(index) {
    fields.splice(index, 1);
    render();
}

function handleSubmit() {

    if (fields.length === 0) {
        alert('Add at least one field');
        return false;
    }

    for (let i = 0; i < fields.length; i++) {

        if (!fields[i].label.trim()) {
            alert(`Field ${i+1}: Label required`);
            return false;
        }

        if (!fields[i].name.trim()) {
            alert(`Field ${i+1}: Name required`);
            return false;
        }

        if ((fields[i].type === 'dropdown' || fields[i].type === 'checkbox')) {

            let valid = fields[i].options.filter(o => o.trim() !== '');

            if (valid.length === 0) {
                alert(`Field ${i+1}: Add options`);
                return false;
            }
        }
    }

    document.getElementById('fieldsInput').value = JSON.stringify(fields);

    return true;
}
</script>

@endsection