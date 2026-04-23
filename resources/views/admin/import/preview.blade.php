@extends('layouts.admin')

@section('title', 'Preview')

@section('content')

<h3 class="text-green-600">Valid Rows</h3>

<table class="mb-6">
@foreach($valid as $row)
<tr><td>{{ implode(', ', $row) }}</td></tr>
@endforeach
</table>

<h3 class="text-red-600">Invalid Rows</h3>

<table>
@foreach($invalid as $row)
<tr><td>{{ implode(', ', $row) }}</td></tr>
@endforeach
</table>

<form method="POST" action="{{ route('admin.import.store') }}">
    @csrf
    <input type="hidden" name="valid_rows" value="{{ json_encode($valid) }}">
    <button class="bg-green-500 text-white px-4 py-2">Confirm Import</button>
</form>

@endsection