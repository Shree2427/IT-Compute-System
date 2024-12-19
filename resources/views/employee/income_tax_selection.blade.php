@extends('layouts.app')

@section('title', 'Income Tax Selection')

@section('content')
<div class="max-w-4xl mx-auto m-8">
    <div class="flex gap-5 mb-6">
        <a href="/dashboard" class="px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300">
            Home
        </a>
    </div>

    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="card shadow-lg rounded-lg">
                <div class="card-header bg-primary text-white px-6 py-4">
                    <h3 class="text-2xl font-semibold">Select Financial Year and Employee ID</h3>
                </div>
                <div class="card-body px-6 py-4">
                    <!-- Form for selecting financial year and employee ID -->
                    <form action="{{ route('income_tax_compute') }}" method="POST">
                        @csrf

                        <!-- Financial Year -->
                        <div class="mb-6">
                            <label for="financial_year" class="block text-lg font-medium text-gray-700">Financial Year</label>
                            <select name="financial_year" id="financial_year" class="form-select mt-1 py-3 px-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                <option value="">Select Financial Year</option>
                                @foreach($financialYears as $financialYear)
                                    <option value="{{ $financialYear->financial_year }}">{{ $financialYear->financial_year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Employee ID -->
                        <div class="mb-6">
                            <label for="employee_id" class="block text-lg font-medium text-gray-700">Employee ID</label>
                            <input type="number" name="employee_id" id="employee_id" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
                                Compute Income Tax
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
