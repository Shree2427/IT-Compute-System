@extends('layouts.app')

@section('title', 'Add New Employer')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow-md">
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
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Add New Employer</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 text-sm text-green-700 bg-green-100 p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/employer') }}" method="POST">
        @csrf

        <!-- TAN Field -->
        <div class="mb-4">
            <label for="tan" class="block text-sm font-medium text-gray-700">TAN</label>
            <input type="text" id="tan" name="tan" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('tan') }}" required>
            @error('tan')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Name of Institute -->
        <div class="mb-4">
            <label for="name_of_institute" class="block text-sm font-medium text-gray-700">Name of Institute</label>
            <input type="text" id="name_of_institute" name="name_of_institute" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('name_of_institute') }}" required>
            @error('name_of_institute')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- City -->
        <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <input type="text" id="city" name="city" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('city') }}" required>
            @error('city')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pincode -->
        <div class="mb-4">
            <label for="pincode" class="block text-sm font-medium text-gray-700">Pincode</label>
            <input type="text" id="pincode" name="pincode" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('pincode') }}" required>
            @error('pincode')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Name of DDO -->
        <div class="mb-4">
            <label for="name_of_ddo" class="block text-sm font-medium text-gray-700">Name of DDO/Employer</label>
            <input type="text" id="name_of_ddo" name="name_of_ddo" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('name_of_ddo') }}" required>
            @error('name_of_ddo')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Designation -->
        <div class="mb-4">
            <label for="designation" class="block text-sm font-medium text-gray-700">Designation</label>
            <input type="text" id="designation" name="designation" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('designation') }}" required>
            @error('designation')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Employer PAN -->
        <div class="mb-6">
            <label for="employer_pan" class="block text-sm font-medium text-gray-700">Employer PAN</label>
            <input type="text" id="employer_pan" name="employer_pan" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('employer_pan') }}" required>
            @error('employer_pan')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Add Employer
            </button>
        </div>
    </form>
</div>
@endsection
