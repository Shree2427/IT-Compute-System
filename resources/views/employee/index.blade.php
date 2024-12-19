@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
<div class="max-w-4xl mx-auto m-8">
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
    <!-- Page Heading -->
    <h2 class="text-3xl font-semibold text-gray-800 mb-8">Employee List</h2>

    <!-- Search Form -->
    <div class="container mx-auto mb-8">
        <form action="{{ route('employee.index') }}" method="GET" class="shadow-lg p-6 rounded-lg bg-gray-50 max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search by Employee Name -->
                <div class="col-span-1">
                    <input type="text" name="search_name" class="form-input w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500"
                           placeholder="Search by Employee Name" value="{{ request('search_name') }}">
                </div>
                <!-- Search by PAN -->
                <div class="col-span-1">
                    <input type="text" name="search_pan" class="form-input w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500"
                           placeholder="Search by PAN" value="{{ request('search_pan') }}">
                </div>
                <!-- Buttons -->
                <div class="col-span-1 flex space-x-4 items-center">
                    <button type="submit" class="btn bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                        <i class="bi bi-search"></i> Search
                    </button>
                    <a href="{{ route('employee.index') }}" class="btn bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Add Employee Button -->
    <div class="text-right mb-6">
        <a href="{{ route('employee.create') }}" class="btn bg-green-600 text-white px-6 py-2 rounded-md shadow-lg hover:bg-green-700">
            <i class="bi bi-plus-circle"></i> Add Employee
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- Employee Table -->
    <div class="overflow-x-auto shadow-lg rounded-lg">
        <table class="table-auto w-full text-left bg-white border-separate border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">PAN</th>
                    <th class="px-4 py-2">Basic Salary</th>
                    <th class="px-4 py-2">Location</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-2">{{ $employee->id }}</td>
                        <td class="px-4 py-2">{{ $employee->employee_name }}</td>
                        <td class="px-4 py-2">{{ $employee->pan }}</td>
                        <td class="px-4 py-2">₹ {{ number_format($employee->basic_salary, 2) }}</td>
                        <td class="px-4 py-2">
                            <span class="badge {{ $employee->location == 'rural' ? 'bg-green-500' : ($employee->location == 'city' ? 'bg-yellow-400' : 'bg-red-500') }} text-white px-4 py-2 rounded-md">
                                {{ ucfirst($employee->location) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <!-- View Button -->
                            <a href="{{ route('employee.show', $employee->id) }}" class="btn bg-blue-600 text-white text-sm py-1 px-3 rounded-md hover:bg-blue-700">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <!-- Edit Button -->
                            <a href="{{ route('employee.edit', $employee->id) }}" class="btn bg-yellow-500 text-white text-sm py-1 px-3 rounded-md hover:bg-yellow-600">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn bg-red-600 text-white text-sm py-1 px-3 rounded-md hover:bg-red-700">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $employees->links() }}
    </div>
</div>
@endsection
