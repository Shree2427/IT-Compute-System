@extends('layouts.app')

@section('title', 'Edit Employer')

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
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Edit Employer</h2>

    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employer.update', $employer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- TAN Field -->
        <div class="mb-4">
            <label for="tan" class="block text-sm font-medium text-gray-700">TAN</label>
            <input type="text" id="tan" name="tan" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('tan', $employer->tan) }}" required>
        </div>

        <!-- Name of Institute -->
        <div class="mb-4">
            <label for="name_of_institute" class="block text-sm font-medium text-gray-700">Name of Institute</label>
            <input type="text" id="name_of_institute" name="name_of_institute" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('name_of_institute', $employer->name_of_institute) }}" required>
        </div>

        <!-- City -->
        <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <input type="text" id="city" name="city" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('city', $employer->city) }}" required>
        </div>

        <!-- Pincode -->
        <div class="mb-4">
            <label for="pincode" class="block text-sm font-medium text-gray-700">Pincode</label>
            <input type="text" id="pincode" name="pincode" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('pincode', $employer->pincode) }}" required>
        </div>

        <!-- Name of DDO -->
        <div class="mb-4">
            <label for="name_of_ddo" class="block text-sm font-medium text-gray-700">Name of DDO</label>
            <input type="text" id="name_of_ddo" name="name_of_ddo" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('name_of_ddo', $employer->name_of_ddo) }}" required>
        </div>

        <!-- Designation -->
        <div class="mb-4">
            <label for="designation" class="block text-sm font-medium text-gray-700">Designation</label>
            <input type="text" id="designation" name="designation" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('designation', $employer->designation) }}" required>
        </div>

        <!-- Employer PAN -->
        <div class="mb-6">
            <label for="employer_pan" class="block text-sm font-medium text-gray-700">Employer PAN</label>
            <input type="text" id="employer_pan" name="employer_pan" class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('employer_pan', $employer->employer_pan) }}" required>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center space-x-4">
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Update Employer
            </button>
            <a href="{{ route('employer.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
