@extends('layouts.admin')

@section('title', 'Submissions')

@section('content')

<table class="w-full bg-white shadow">
    <tr class="bg-gray-200">
        <th>ID</th>
        <th>Form</th>
        <th>Data</th>
        <th>Action</th>
    </tr>

    @foreach($data as $row)
    <tr class="border">
        <td>{{ $row->id }}</td>
        <td>{{ $row->form->title ?? '' }}</td>
        <td>
            @foreach($row->values as $val)
                <div>
                    <b>{{ $val->field->label ?? 'Field' }}</b>: {{ $val->value }}
                </div>
            @endforeach
        </td>
        <td>
            <form method="POST"
                  action="{{ route('admin.submissions.destroy',$row->id) }}">
                @csrf @method('DELETE')
                <button class="text-red-500">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>
<a href="{{ route('admin.submissions.create') }}"
   class="bg-blue-500 text-white px-4 py-2 rounded mb-3 inline-block">
   + New Submission
</a>
{{ $data->links() }}

@endsection