@extends('layouts.app')

    @section('title', 'Financial Settings')

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
        <div class="text-right mb-6">
        <a href="{{ route('settings.create') }}" class="btn bg-green-600 text-white px-6 py-2 rounded-md shadow-lg hover:bg-green-700">
            <i class="bi bi-plus-circle"></i> Add New Setting
        </a>
    </div>
        <h1 class="text-3xl font-semibold text-center mb-6">Financial Settings</h1>
  <!-- Add Employee Button -->

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success text-green-600 bg-green-100 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Buttons for Financial Years -->
        <div class="btn-group-vertical flex flex-wrap justify-center gap-10 w-full  mx-auto" role="group">
            @foreach($settings as $setting)
                <div class="justify-content-between flex flex-col align-items-center gap-3  mb-4">
                    <button class="btn btn-primary w-full p-3  text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 financial-year-btn" data-year="{{ $setting->financial_year }}">
                        {{ $setting->financial_year }}
                    </button>
                    <a href="{{ route('financial-settings.edit', $setting->id) }}" class="edit-btn text-red-500 ml-2 hover:underline">
                        Edit
                    </a>
                </div>
            @endforeach

        </div>

        <!-- Financial Year Settings Display -->
        <div id="settings-container">
            @foreach($settings as $setting)
                <div class="card financial-year-settings" id="settings-{{ $setting->financial_year }}" style="display: none;">
                    <div class="card-body bg-white p-6 rounded-lg shadow-md mb-4">
                        <h4 class="text-xl font-semibold mb-4">Financial Year: {{ $setting->financial_year }}</h4>
                        <ul class="space-y-4">
                            <li>
                                <strong class="text-lg">DA (Selected Months):</strong>
                                <ul class="list-disc pl-5">
                                    @php
                                        $daData = json_decode($setting->da_amount, true);
                                    @endphp
                                    @if (!empty($daData) && is_array($daData))
                                        @foreach ($daData as $month => $percentage)
                                            <li>{{ $month }}: {{ $percentage }}%</li>
                                        @endforeach
                                    @else
                                        <li>No DA data available.</li>
                                    @endif
                                </ul>
                            </li>
                            <li><strong class="text-lg">HRA (Rural):</strong> {{ $setting->hra_rural }}%</li>
                            <li><strong class="text-lg">HRA (City):</strong> {{ $setting->hra_city }}%</li>
                            <li><strong class="text-lg">HRA (Metro):</strong> {{ $setting->hra_metro }}%</li>
                            <li><strong class="text-lg">CCA Amount:</strong> ₹{{ number_format($setting->cca_amount, 2) }}</li>
                            <li><strong class="text-lg">MA Amount:</strong> ₹{{ number_format($setting->ma_amount, 2) }}</li>
                            <li><strong class="text-lg">Other Allowance:</strong> ₹{{ number_format($setting->other_allowance, 2) }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const allSettings = document.querySelectorAll('.financial-year-settings');
            allSettings.forEach(setting => setting.style.display = 'none');

            const buttons = document.querySelectorAll('.financial-year-btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const year = this.getAttribute('data-year');
                    const setting = document.getElementById('settings-' + year);

                    allSettings.forEach(setting => setting.style.display = 'none');
                    if (setting) setting.style.display = 'block';
                });
            });
        });
    </script>

    @endsection
