@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="h-screen bg-gray-100 flex flex-col items-center justify-center">
    <div class="w-full max-w-4xl p-6 bg-white rounded-lg shadow-lg">
        <!-- Dashboard Header -->
        <h2 class="text-3xl font-bold text-center text-green-700"> Payroll Dashboard</h2>

        <!-- Logout Form -->
        <form action="{{ route('logout') }}" method="POST" class="mt-6 flex justify-end">
            @csrf
            <button
                type="submit"
                class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300"
            >
                Logout
            </button>
        </form>

        <!-- Navigation Buttons -->
        <div class="grid grid-cols-3 gap-7 mt-8">
            <button
                onclick="window.location.href='{{ route('employer.index') }}'"
                class="w-full px-4 py-4 text-xl text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
            >
                Employer
            </button>
            <button
                onclick="window.location.href='{{ route('employee.index') }}'"
                class="w-full px-4 py-4 text-xl text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
            >
                Employee
            </button>
            <button
                onclick="window.location.href='{{ route('employee.income_tax_selection') }}'"
                class="w-full px-4 py-4 text-xl text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
            >
                IT Computation
            </button>
            <!-- <button
                onclick="window.location.href='/form16'"
                class="w-full px-4 py-4 text-xl text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
            >
                Form 16
            </button> -->
            <!-- <button
                onclick="window.location.href='/itr'"
                class="w-full px-4 py-4 text-xl text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
            >
                ITR
            </button> -->
            <button
                onclick="window.location.href='/settings'"
                class="w-full px-4 py-4 text-xl text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
            >
                Settings
            </button>
        </div>
    </div>
</div>

@endsection
