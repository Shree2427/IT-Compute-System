@extends('layouts.app')

@section('title')
    Employer List
@endsection

@section('content')


<div class="min-h-screen bg-gray-100 flex flex-col items-center p-6">

    <div class="w-full max-w-6xl bg-white p-6 rounded-lg shadow-lg">
        <div class="flex my-4 gap-5 flex-wrap">
            <a href="/dashboard"
                class="px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300">
                 Home
             </a>
             <a href="{{ url()->previous() }}"
                class="px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300">
                 Back
             </a>
        </div>
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-700">Employers List</h2>
            <a
                href="{{ url('/employer/create') }}"
                class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
            >
                Add New Employer
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('employer.index') }}" class="mb-6">
            <div class="flex items-center">
                <input
                    type="text"
                    name="search"
                    placeholder="Search Employers"
                    value="{{ request('search') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500"
                />
                <button
                    type="submit"
                    class="ml-2 px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
                >
                    Search
                </button>
            </div>
        </form>

        <!-- Employers Table -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300 text-left">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">TAN</th>
                        <th class="px-4 py-2 border">Name of Institute</th>
                        <th class="px-4 py-2 border">City</th>
                        <th class="px-4 py-2 border">Pincode</th>
                        <th class="px-4 py-2 border">Name of DDO</th>
                        <th class="px-4 py-2 border">Designation</th>
                        <th class="px-4 py-2 border">Employer PAN</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employers as $employer)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border">{{ $employer->tan }}</td>
                            <td class="px-4 py-2 border">{{ $employer->name_of_institute }}</td>
                            <td class="px-4 py-2 border">{{ $employer->city }}</td>
                            <td class="px-4 py-2 border">{{ $employer->pincode }}</td>
                            <td class="px-4 py-2 border">{{ $employer->name_of_ddo }}</td>
                            <td class="px-4 py-2 border">{{ $employer->designation }}</td>
                            <td class="px-4 py-2 border">{{ $employer->employer_pan }}</td>
                            <td class="px-4 py-2 border">
                                <a
                                    href="{{ route('employer.edit', $employer->id) }}"
                                    class="px-3 py-1 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300"
                                >
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-center text-gray-500">
                                No employers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $employers->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
