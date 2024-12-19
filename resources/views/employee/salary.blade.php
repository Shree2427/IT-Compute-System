{{-- resources/views/employee/salary.blade.php --}}

@extends('layouts.app')

@section('content')
body {
        background-color: lightblue; /* Background color for the entire body */
    }
    <div class="container">
        <h1>Salary Details for {{ $employee->employee_name }}</h1>

        <table class="table table-bordered">
            <tr>
                <th>Basic Salary</th>
                <td>{{ $employee->basic_salary }}</td>
            </tr>
            <tr>
                <th>DA (Jan to June)</th>
                <td>{{ $da }}</td>
            </tr>
            <tr>
                <th>HRA ({{ $employee->location }})</th>
                <td>{{ $hra }}</td>
            </tr>
            <tr>
                <th>CCA</th>
                <td>{{ $cca }}</td>
            </tr>
            <tr>
                <th>MA</th>
                <td>{{ $ma }}</td>
            </tr>
            <tr>
                <th>Other Allowance</th>
                <td>{{ $otherAllowance }}</td>
            </tr>
            <tr>
                <th>Gross Salary</th>
                <td>{{ $grossSalary }}</td>
            </tr>
            <tr>
                <th>Provident Fund (PF)</th>
                <td>{{ $pf }}</td>
            </tr>
            <tr>
                <th>Income Tax</th>
                <td>{{ $incomeTax }}</td>
            </tr>
            <tr>
                <th>Net Salary</th>
                <td>{{ $netSalary }}</td>
            </tr>
        </table>
    </div>
@endsection
