@extends('layouts.app')

@section('title', 'Edit Employee')

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
    <h1 class="text-3xl font-semibold mb-8">Edit Employee</h1>

    <!-- Error messages -->
    @if ($errors->any())
        <div class="alert alert-danger bg-red-100 border border-red-500 text-red-500 p-4 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employee.update', $employee->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Employee Name -->
        <div>
            <label for="employee_name" class="block text-lg font-medium text-gray-700">Employee Name</label>
            <input type="text" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="employee_name" name="employee_name" value="{{ old('employee_name', $employee->employee_name) }}" required>
        </div>

        <!-- PAN -->
        <div>
            <label for="pan" class="block text-lg font-medium text-gray-700">PAN</label>
            <input type="text" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="pan" name="pan" value="{{ old('pan', $employee->pan) }}" required>
        </div>

        <!-- Pay Scale -->
        <div class="flex space-x-4">
            <div class="w-1/2">
                <label for="pay_scale" class="block text-lg font-medium text-gray-700">Pay Scale</label>
                <select class="form-select mt-1 py-2 px-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="pay_scale" name="pay_scale">
                    <option value="">-- Select Pay Scale --</option>
                    <option value="6th" {{ old('pay_scale', $employee->pay_scale) == '6th' ? 'selected' : '' }}>6th Pay Scale</option>
                    <option value="7th" {{ old('pay_scale', $employee->pay_scale) == '7th' ? 'selected' : '' }}>7th Pay Scale</option>
                </select>
            </div>

            <!-- Basic Salary -->
            <div class="w-1/2">
                <label for="basic_salary" class="block text-lg font-medium text-gray-700">Basic Salary</label>
                <input type="number" step="0.01" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="basic_salary" name="basic_salary" value="{{ old('basic_salary', $employee->basic_salary) }}" required>
            </div>
        </div>

        <!-- Increment -->
        <div class="flex space-x-4">
            <div class="w-1/2">
                <label for="increment_month" class="block text-lg font-medium text-gray-700">Increment Month</label>
                <select class="form-select mt-1 py-2 px-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="increment_month" name="increment_month">
                    <option value="">-- Select Month --</option>
                    @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                        <option value="{{ $month }}" {{ old('increment_month', $employee->increment_month) == $month ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-1/2">
                <label for="increment_amount" class="block text-lg font-medium text-gray-700">Increment Amount</label>
                <input type="number" step="0.01" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="increment_amount" name="increment_amount" value="{{ old('increment_amount', $employee->increment_amount) }}">
            </div>
        </div>

        <!-- Pay Scale Change -->
        <div class="flex space-x-4">
            <div class="w-1/2">
                <label for="payscale_change_month" class="block text-lg font-medium text-gray-700">Pay Scale Change Month</label>
                <select class="form-select mt-1 block py-2 px-2 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="payscale_change_month" name="payscale_change_month">
                    <option value="">-- Select Month --</option>
                    @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                        <option value="{{ $month }}" {{ old('payscale_change_month', $employee->payscale_change_month) == $month ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-1/2">
                <label for="new_basic_salary" class="block text-lg font-medium text-gray-700">New Basic Salary</label>
                <input type="number" step="0.01" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="new_basic_salary" name="new_basic_salary" value="{{ old('new_basic_salary', $employee->new_basic_salary) }}">
            </div>
        </div>

        <!-- Location -->
        <div>
            <label for="location" class="block text-lg font-medium text-gray-700">Location</label>
            <select class="form-select mt-1 block py-2 px-2 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="location" name="location" required>
                <option value="">-- Select Location --</option>
                <option value="rural" {{ old('location', $employee->location) == 'rural' ? 'selected' : '' }}>Rural</option>
                <option value="city" {{ old('location', $employee->location) == 'city' ? 'selected' : '' }}>City</option>
                <option value="metro" {{ old('location', $employee->location) == 'metro' ? 'selected' : '' }}>Metro</option>
            </select>
        </div>

        <!-- Additional Options (Checkboxes) -->
        <div class="flex space-x-4">
            <div class="flex items-center">
                <input type="checkbox" name="include_cca" id="include_cca" value="1" {{ old('include_cca', $employee->include_cca) ? 'checked' : '' }} class="form-checkbox">
                <label for="include_cca" class="ml-2 text-lg">Include CCA</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="include_da" id="include_da" value="1" {{ old('include_da', $employee->include_da) ? 'checked' : '' }} class="form-checkbox">
                <label for="include_da" class="ml-2 text-lg">Include DA</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="include_ma" id="include_ma" value="1" {{ old('include_ma', $employee->include_ma) ? 'checked' : '' }} class="form-checkbox">
                <label for="include_ma" class="ml-2 text-lg">Include MA</label>
            </div>
        </div>

        <!-- Tax and Other Deductions -->
        <div class="space-y-4">
            <h3 class="text-2xl font-semibold">Deductions</h3>
            <div class="flex space-x-4">
                <div class="w-1/3">
                    <label for="pt" class="block text-lg font-medium text-gray-700">Professional Tax (PT)</label>
                    <input type="number" step="0.01" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="pt" name="pt" value="{{ old('pt') }}">
                </div>
                <div class="w-1/3">
                    <label for="lic" class="block text-lg font-medium text-gray-700">LIC</label>
                    <input type="number" step="0.01" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="lic" name="lic" value="{{ old('lic') }}">
                </div>
                <div class="w-1/3">
                    <label for="others_deductions" class="block text-lg font-medium text-gray-700">Other Deductions</label>
                    <input type="number" step="0.01" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="others_deductions" name="others_deductions" value="{{ old('others_deductions') }}">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Update Employee</button>
        </div>
    </form>
</div>

@endsection
