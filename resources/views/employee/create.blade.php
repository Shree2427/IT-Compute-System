@extends('layouts.app')

@section('title', 'Add New Employee')

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
    <h1 class=" mb-4 text-3xl font-semibold text-gray-800">Create Employee</h1>

    @if ($errors->any())
        <div class="alert alert-danger bg-red-100 text-red-800 border-l-4 border-red-500 p-4 mb-4 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employee.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Employee Name -->
        <div class="mb-4">
            <label for="employee_name" class="block text-sm font-medium text-gray-700">Employee Name</label>
            <input type="text" class="form-input w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="employee_name" name="employee_name" value="{{ old('employee_name') }}" required>
        </div>

        <div class="form-group">
        <label for="employer_id">Employer</label>
        <select name="employer_id" id="employer_id" class="form-control">
            @foreach($employers as $employer)
                <option value="{{ $employer->id }}">{{ $employer->name_of_institute }}</option>
            @endforeach
        </select>
    </div>

        <!-- PAN -->
        <div class="mb-4">
            <label for="pan" class="block text-sm font-medium text-gray-700">PAN</label>
            <input type="text" class="form-input w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="pan" name="pan" value="{{ old('pan') }}" required oninput="this.value = this.value.toUpperCase()">
        </div>

        <!-- Pay Scale -->
        <div class="flex space-x-4">
            <div class="w-full mb-4">
                <label for="pay_scale" class="block text-sm font-medium text-gray-700">Pay Scale</label>
                <select class="form-select w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="pay_scale" name="pay_scale">
                    <option value="">-- Select Pay Scale --</option>
                    <option value="6th" {{ old('pay_scale') == '6th' ? 'selected' : '' }}>6th Pay Scale</option>
                    <option value="7th" {{ old('pay_scale') == '7th' ? 'selected' : '' }}>7th Pay Scale</option>
                </select>
            </div>

            <!-- Basic Salary -->
            <div class="w-full mb-4">
                <label for="basic_salary" class="block text-sm font-medium text-gray-700">Basic Salary</label>
                <input type="number" step="0.01" class="form-input w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="basic_salary" name="basic_salary" value="{{ old('basic_salary') }}" required>
            </div>
        </div>

        <!-- Increment -->
        <div class="flex space-x-4">
            <div class="w-full mb-4">
                <label for="increment_month" class="block text-sm font-medium text-gray-700">Increment Month</label>
                <select class="form-select w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="increment_month" name="increment_month">
                    <option value="">-- Select Month --</option>
                    @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                        <option value="{{ $month }}" {{ old('increment_month') == $month ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full mb-4">
                <label for="increment_amount" class="block text-sm font-medium text-gray-700">Increment Amount</label>
                <input type="number" step="0.01" class="form-input w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="increment_amount" name="increment_amount" value="{{ old('increment_amount') }}">
            </div>
        </div>

        <!-- Pay Scale Change Month -->
        <div class="mb-4">
            <label for="payscale_change_month" class="block text-sm font-medium text-gray-700">Pay Scale Change Month</label>
            <select class="form-select w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="payscale_change_month" name="payscale_change_month">
                <option value="">-- Select Month --</option>
                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                    <option value="{{ $month }}" {{ old('payscale_change_month') == $month ? 'selected' : '' }}>{{ $month }}</option>
                @endforeach
            </select>
        </div>

        <!-- New Pay Scale and New Basic Salary -->
        <div class="flex space-x-4">
            <div class="w-full mb-4">
                <label for="new_pay_scale" class="block text-sm font-medium text-gray-700">New Pay Scale</label>
                <select class="form-select w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="new_pay_scale" name="new_pay_scale">
                    <option value="">-- Select New Pay Scale --</option>
                    <option value="6th" {{ old('new_pay_scale') == '6th' ? 'selected' : '' }}>6th Pay Scale</option>
                    <option value="7th" {{ old('new_pay_scale') == '7th' ? 'selected' : '' }}>7th Pay Scale</option>
                </select>
            </div>
            <div class="w-full mb-4">
                <label for="new_basic_salary" class="block text-sm font-medium text-gray-700">New Basic Salary</label>
                <input type="number" step="0.01" class="form-input w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="new_basic_salary" name="new_basic_salary" value="{{ old('new_basic_salary') }}">
            </div>
        </div>

        <!-- Location -->
        <div class="mb-4">
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <select class="form-select w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" id="location" name="location" required>
                <option value="">-- Select Location --</option>
                <option value="rural" {{ old('location') == 'rural' ? 'selected' : '' }}>Rural</option>
                <option value="city" {{ old('location') == 'city' ? 'selected' : '' }}>City</option>
                <option value="metro" {{ old('location') == 'metro' ? 'selected' : '' }}>Metro</option>
            </select>
        </div>

        <!-- Additional Options (Checkboxes) -->
        <div class="flex space-x-4">
            <div class="w-full mb-4">
                <label for="include_cca" class="flex items-center">
                    <input type="checkbox" name="include_cca" id="include_cca" value="1" class="form-checkbox" {{ old('include_cca') ? 'checked' : '' }}>
                    <span class="ml-2 text-sm">Include CCA</span>
                </label>
            </div>
            <div class="w-full mb-4">
                <label for="include_da" class="flex items-center">
                    <input type="checkbox" name="include_da" id="include_da" value="1" class="form-checkbox" {{ old('include_da') ? 'checked' : '' }}>
                    <span class="ml-2 text-sm">Include DA</span>
                </label>
            </div>
            <div class="w-full mb-4">
                <label for="include_ma" class="flex items-center">
                    <input type="checkbox" name="include_ma" id="include_ma" value="1" class="form-checkbox" {{ old('include_ma') ? 'checked' : '' }}>
                    <span class="ml-2 text-sm">Include MA</span>
                </label>
            </div>
        </div>

        <div class="flex space-x-4">
            <div class="w-full mb-4">
                <label for="include_personal_pay" class="flex items-center">
                    <input type="checkbox" name="include_personal_pay" id="include_personal_pay" value="1" class="form-checkbox" {{ old('include_personal_pay') ? 'checked' : '' }}>
                    <span class="ml-2 text-sm">Include Personal Pay</span>
                </label>
            </div>
            <div class="w-full mb-4">
                <label for="include_house_rent" class="flex items-center">
                    <input type="checkbox" name="include_house_rent" id="include_house_rent" value="1" class="form-checkbox" {{ old('include_house_rent') ? 'checked' : '' }}>
                    <span class="ml-2 text-sm">Include House Rent</span>
                </label>
            </div>
        </div>
        <!-- Tax and Other Deductions -->
        <div class="row">
                <h3>Deductions</h3>
                <div class="col-md-4 mb-3">
                    <label for="pt" class="form-label">Professional Tax (PT)</label>
                    <input type="number" step="0.01" class="form-control" id="pt" name="pt" value="{{ old('pt') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="lic" class="form-label">LIC</label>
                    <input type="number" step="0.01" class="form-control" id="lic" name="lic" value="{{ old('lic') }}">
                </div>

                <div class="form-group">
    <label for="include_nps">Include NPS</label>
    <input type="checkbox" id="include_nps" name="include_nps" value="1" 
        {{ old('include_nps', $employee->include_nps ?? false) ? 'checked' : '' }}>
</div>


                <div class="col-md-4 mb-3">
                    <label for="gpf" class="form-label">GPF</label>
                    <input type="number" step="0.01" class="form-control" id="gpf" name="gpf" value="{{ old('gpf') }}">
                </div>
            </div>

            <!-- Other Fixed Deductions -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="kgid" class="form-label">KGID</label>
                    <input type="number" step="0.01" class="form-control" id="kgid" name="kgid" value="{{ old('kgid') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="gis" class="form-label">GIS</label>
                    <input type="number" step="0.01" class="form-control" id="gis" name="gis" value="{{ old('gis') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="gis" class="form-label">IT</label>
                    <input type="number" step="0.01" class="form-control" id="it" name="it" value="{{ old('it') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="others" class="form-label">Others</label>
                    <input type="number" step="0.01" class="form-control" id="others" name="others" value="{{ old('others') }}">
                </div>
            </div>
            <div class="mb-3">
            <label for="ph" class="form-label">
                <input type="checkbox" name="ph" id="ph" value="1" {{ old('ph') ? 'checked' : '' }}>
                Physical Handicap (PH)
            </label>
        </div>

        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit" class="w-full py-3 px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">Create Employee</button>
        </div>
    </form>
</div>

@endsection
