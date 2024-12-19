@extends('layouts.app')

@section('title', 'Create Financial Setting')

@section('content')
<style>
    body {
        background-color: lightblue;
    }

    .form-group input[type="number"] {
        border-color: #ccc;
        border-radius: 4px;
        padding: 8px;
        width: 100%; /* Make input fields take up the full width */
        height: 40px; /* Ensure the height is consistent */
    }

    .form-group label {
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    /* Style for DA Settings to align checkbox and input neatly */
    .da-months .month-group {
        display: flex;
        flex-direction: column; /* Stack checkbox and input vertically */
        margin-bottom: 1rem;
    }

    .da-months input[type="checkbox"] {
        margin-right: 10px; /* Add space between the checkbox and the input field */
        height: 30px; /* Consistent height for checkboxes */
        width: 30px;  /* Make checkboxes uniform */
    }

    .da-months input[type="number"] {
        display: inline-block;
        height: 40px; /* Set a uniform height for the input boxes */
        width: 100%; /* Ensure the input box takes full width available */
        padding: 8px;
        margin-top: 10px; /* Space between checkbox and input field */
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group input {
        margin-top: 5px; /* Space between label and input */
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
    }
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4 text-info">Create Financial Setting</h1>

    <form action="{{ route('settings.store') }}" method="POST" class="shadow-lg p-4 bg-white rounded">
        @csrf

        <!-- Financial Year Dropdown -->
        <div class="form-group mb-3">
            <label for="financial_year" class="form-label">Financial Year</label>
            <select name="financial_year" id="financial_year" class="form-select" required>
                <option value="" disabled selected>Select Financial Year</option>
                @foreach(range(date('Y') - 5, date('Y') + 5) as $year)
                    <option value="{{ $year }}-{{ $year + 1 }}">{{ $year }}-{{ $year + 1 }}</option>
                @endforeach
            </select>
        </div>

    <!-- DA Settings -->
    <div class="form-group mb-3">
    <label class="form-label">DA Settings</label>
    <div class="da-months">
        @foreach(['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February'] as $month)
            <div class="month-group">
                <input type="checkbox" name="da_months[]" value="{{ $month }}" id="da_{{ $month }}" class="form-check-input">
                <label for="da_{{ $month }}" class="form-check-label">{{ $month }}</label>
                <input type="number" name="da_percentage[{{ $month }}]" placeholder="DA %" class="form-control" step="0.01" required>
            </div>
        @endforeach
    </div>
</div>


        <!-- Other Financial Settings -->
        <div class="form-group mb-3">
            <label for="cca_amount" class="form-label">CCA Amount</label>
            <input type="number"  step="0.01" name="cca_amount" id="cca_amount" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="ma_amount" class="form-label">MA Amount</label>
            <input type="number"  step="0.01" name="ma_amount" id="ma_amount" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="sfa" class="form-label">SFN</label>
            <input type="number"  step="0.01" name="sfa" id="sfa" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="hra_rural" class="form-label">HRA (Rural)</label>
            <input type="number" step="0.01" name="hra_rural" id="hra_rural" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="hra_city" class="form-label">HRA (City)</label>
            <input type="number" step="0.01" name="hra_city" id="hra_city" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="hra_metro" class="form-label">HRA (Metro)</label>
            <input type="number"  step="0.01" name="hra_metro" id="hra_metro" class="form-control" required>
        </div>

        <div class="form-group mb-4">
            <label for="other_allowance" class="form-label">Other Allowance</label>
            <input type="number" step="0.01" name="other_allowance" id="other_allowance" class="form-control" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg px-4">Save Settings</button>
        </div>
    </form>
</div>
@endsection
