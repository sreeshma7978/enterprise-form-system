<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Card -->
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     Welcome, {{ auth()->user()->name }}!
                </div>
            </div>

            @if(auth()->user()->role === 'admin')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Forms -->
                    <a href="{{ route('admin.forms.index') }}"
                        class="block p-6 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                        <h3 class="text-lg font-bold">Forms</h3>
                        <p>Manage dynamic forms</p>
                    </a>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}"
                        class="block p-6 bg-green-500 text-white rounded-lg shadow hover:bg-green-600">
                        <h3 class="text-lg font-bold">Users</h3>
                        <p>View system users</p>
                    </a>

                    <!-- Submissions -->
                    <a href="{{ route('admin.submissions.index') }}"
                        class="block p-6 bg-purple-500 text-white rounded-lg shadow hover:bg-purple-600">
                        <h3 class="text-lg font-bold">Submissions</h3>
                        <p>Manage form submissions</p>
                    </a>

                    <!-- Import -->
                    <a href="{{ route('admin.import.index') }}"
                        class="block p-6 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600">
                        <h3 class="text-lg font-bold">Import</h3>
                        <p>Upload CSV data</p>
                    </a>

                    <!-- Export -->
                    <a href="{{ route('admin.export') }}"
                        class="block p-6 bg-indigo-500 text-white rounded-lg shadow hover:bg-indigo-600">
                        <h3 class="text-lg font-bold">Export</h3>
                        <p>Download submissions</p>
                    </a>

                </div>

            @else

                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You are logged in as a user.
                    </div>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>