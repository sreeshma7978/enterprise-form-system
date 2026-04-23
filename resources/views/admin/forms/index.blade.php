<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white min-h-screen p-5">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

        <ul class="space-y-3">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.forms.index') }}">Forms</a></li>
            <li><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li><a href="{{ route('admin.submissions.index') }}">Submissions</a></li>
            <li><a href="{{ route('admin.import.index') }}">Import</a></li>
            <li><a href="{{ route('admin.export') }}">Export</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="flex-1 p-6">

        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">@yield('title')</h1>
            @include('admin.forms.create')
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-500 px-3 py-1 text-white rounded">Logout</button>
            </form>
        </div>

        @yield('content')

    </div>

</div>

</body>
</html>