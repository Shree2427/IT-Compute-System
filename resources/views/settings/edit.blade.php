@extends('layouts.app')

@section('title', 'Edit Financial Year: {{ $setting->financial_year }}')

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
    <h1 class="text-3xl font-semibold  mb-6">Edit Financial Year: {{ $setting->financial_year }}</h1>

    <!-- Form for editing financial year settings -->
    <form action="{{ route('settings.update', $setting->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Financial Year -->
        <div>
            <label for="financial_year" class="block text-lg font-medium">Financial Year:</label>
            <input type="text" id="financial_year" name="financial_year" value="{{ $setting->financial_year }}"
                required class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <!-- DA Amount (Monthly Fields) -->
        <div>
            <h3 class="text-xl font-semibold">DA Amounts (Monthly):</h3>
            <div class="grid grid-cols-2 gap-4 mt-4">
                @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                    <div class="flex flex-col">
                        <label for="da_{{ strtolower($month) }}" class="text-sm font-medium">{{ $month }}</label>
                        <input type="number" id="da_{{ strtolower($month) }}" name="da_amount[{{ $month }}]"
                            value="{{ $setting->da_amount[$month] ?? 0 }}" step="0.01"
                            class="mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                @endforeach
            </div>
        </div>

        <!-- HRA, CCA, MA, Other Allowances -->
        <div class="space-y-4">
            <div>
                <label for="hra_rural" class="block text-lg font-medium">HRA (Rural):</label>
                <input type="number" id="hra_rural" name="hra_rural" value="{{ $setting->hra_rural }}" step="0.01"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div>
                <label for="hra_city" class="block text-lg font-medium">HRA (City):</label>
                <input type="number" id="hra_city" name="hra_city" value="{{ $setting->hra_city }}" step="0.01"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div>
                <label for="hra_metro" class="block text-lg font-medium">HRA (Metro):</label>
                <input type="number" id="hra_metro" name="hra_metro" value="{{ $setting->hra_metro }}" step="0.01"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div>
                <label for="cca_amount" class="block text-lg font-medium">CCA Amount:</label>
                <input type="number" id="cca_amount" name="cca_amount" value="{{ $setting->cca_amount }}" step="0.01"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div>
                <label for="ma_amount" class="block text-lg font-medium">MA Amount:</label>
                <input type="number" id="ma_amount" name="ma_amount" value="{{ $setting->ma_amount }}" step="0.01"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div>
                <label for="sfa" class="block text-lg font-medium">SFA:</label>
                <input type="number" id="sfa" name="sfa" value="{{ $setting->sfa }}" step="0.01"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div>
                <label for="other_allowance" class="block text-lg font-medium">Other Allowance:</label>
                <input type="number" id="other_allowance" name="other_allowance" value="{{ $setting->other_allowance }}" step="0.01"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
