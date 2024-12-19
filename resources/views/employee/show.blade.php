@extends('layouts.app')

@section('title', 'Employee Details')


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
    <h1 class="text-3xl font-semibold text-center mb-6">{{ $employee->employee_name }} - Employee Details</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <ul class="space-y-4">
            <li class="flex justify-between">
                <span class="font-medium text-lg">PAN:</span>
                <span>{{ $employee->pan }}</span>
            </li>
            <li class="flex justify-between">
                <span class="font-medium text-lg">Basic Salary:</span>
                <span>₹{{ number_format($employee->basic_salary, 2) }}</span>
            </li>
            <li class="flex justify-between">
                <span class="font-medium text-lg">HRA Type:</span>
                <span>{{ ucfirst($employee->location) }}</span>
            </li>
            <li class="flex justify-between">
                <span class="font-medium text-lg">Increment Month:</span>
                <span>{{ $employee->increment_month }}</span>
            </li>
            <li class="flex justify-between">
                <span class="font-medium text-lg">Payscale Change Month:</span>
                <span>{{ $employee->payscale_change_month }}</span>
            </li>
        </ul>
    </div>


</div>
@endsection
