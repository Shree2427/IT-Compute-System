{{-- resources/views/salary/show.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Salary Details for {{ $employee->employee_name }}</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Employee Details</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Employee Name</th>
                    <td>{{ $employee->employee_name }}</td>
                </tr>
                <tr>
                    <th>Basic Salary</th>
                    <td>{{ number_format($employee->basic_salary, 2) }}</td>
                </tr>
                <tr>
                    <th>Financial Year</th>
                    <td>{{ $employee->financial_year }}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>{{ ucfirst($employee->location) }}</td>
                </tr>
                <tr>
                    <th>Increment Month</th>
                    <td>{{ $employee->increment_month }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Salary Components</h5>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Component</th>
                    <th>Amount (₹)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Dearness Allowance (DA)</td>
                    <td>{{ number_format($da, 2) }}</td>
                </tr>
                <tr>
                    <td>House Rent Allowance (HRA)</td>
                    <td>{{ number_format($hra, 2) }}</td>
                </tr>
                <tr>
                    <td>City Compensatory Allowance (CCA)</td>
                    <td>{{ number_format($cca, 2) }}</td>
                </tr>
                <tr>
                    <td>Medical Allowance (MA)</td>
                    <td>{{ number_format($ma, 2) }}</td>
                </tr>
                <tr>
                    <td>Special Allowance (SFA)</td>
                    <td>{{ number_format($sfa, 2) }}</td>
                </tr>
                <tr>
                    <td>Other Allowances</td>
                    <td>{{ number_format($otherAllowance, 2) }}</td>
                </tr>
                <tr>
                    <td>PH Allowance</td>
                    <td>{{ number_format($phAllowance, 2) }}</td>
                </tr>
                <tr>
                    <th>Gross Salary</th>
                    <th>{{ number_format($grossSalary, 2) }}</th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Deductions</h5>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Deduction</th>
                    <th>Amount (₹)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Professional Tax (PT)</td>
                    <td>{{ number_format($employee->pt, 2) }}</td>
                </tr>
                <tr>
                    <td>LIC</td>
                    <td>{{ number_format($employee->lic, 2) }}</td>
                </tr>
                <tr>
                    <td>GPF</td>
                    <td>{{ number_format($employee->gpf, 2) }}</td>
                </tr>
                <tr>
                    <td>GIS</td>
                    <td>{{ number_format($employee->gis, 2) }}</td>
                </tr>
                <tr>
                    <td>Others</td>
                    <td>{{ number_format($employee->others, 2) }}</td>
                </tr>
                <tr>
                    <td>KGID</td>
                    <td>{{ number_format($employee->kgid, 2) }}</td>
                </tr>
                <tr>
                    <td>Income Tax (IT)</td>
                    <td>{{ number_format($employee->it, 2) }}</td>
                </tr>
                <tr>
                    <th>Total Deductions</th>
                    <th>{{ number_format($totalDeductions, 2) }}</th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title text-success">Net Salary</h5>
            <h3>₹ {{ number_format($netSalary, 2) }}</h3>
        </div>
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">Go Back</a>
</div>
</body>
</html>
