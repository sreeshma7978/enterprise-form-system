@extends('layouts.admin')

@section('title', 'Import CSV')

@section('content')

<form method="POST" action="{{ route('admin.import.preview') }}" enctype="multipart/form-data">
    @csrf

    <input type="file" name="file" class="mb-4">

    <button class="bg-blue-500 text-white px-4 py-2">Preview</button>
</form>

@endsection