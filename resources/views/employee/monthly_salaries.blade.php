@extends('layouts.app')

@section('title', 'Monthly Salaries')

@section('content')
<div class="container">
    <h1>Monthly Salaries for {{ $employee->employee_name }}</h1>
    <h3>Financial Year: {{ date('Y', strtotime($employee->financial_year_start)) }} - {{ date('Y', strtotime($employee->financial_year_start) + (60 * 60 * 24 * 365)) }}</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Month</th>
                <th>Pay Scale</th>
                <th>Basic Salary (₹)</th>
                <th>DA</th>
                <th>HRA</th>
                <th>CCA</th>
                <th>MA</th>
                <th>SFN</th>
                <th>OTHERS</th>
                <th>PT</th>
                <th>LIC</th>
                <th>GPF</th>
                <th>GIS</th>
                <th>KGID</th>
                <th>IT</th>
                <th>Ph_allowance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaries as $salary)
                <tr>
                    <td>{{ $salary['month'] }}</td>
                    <td>{{ $salary['pay_scale'] }}</td>
                    <td>{{ number_format($salary['basic_salary'], 2) }}</td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
