
@extends('layouts.app')

@section('title', 'Income Tax Computation')

@section('content')

<div class="max-w-4xl mx-auto m-8">
    <div class="flex gap-5 mb-6">
        <a href="/dashboard" class="px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300">
            Home
        </a>
        <a href="{{ url()->previous() }}" class="px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300">
            Back
        </a>
    </div>
        <h2 class="text-2xl font-bold mb-6">COMPUTATION OF INCOME TAX FOR THE FINANCIAL YEAR {{ $financial_year }}</h2>
<!-- Employee Details Section -->
<div class="bg-white shadow-md rounded p-4 mb-6">
            <p><strong>Name:</strong> <span>{{ $employee->employee_name }}</span></p>
            <!-- <p><strong>Designation:</strong> <span>{{ $employee->designation }}</span></p> -->
            <p><strong>PAN:</strong> <span>{{ $employee->pan }}</span></p>
            <!-- <p><strong>Organization:</strong> <span>XYZ Corporation</span></p> -->
        </div>

        <form action="{{ route('income_tax_compute') }}" method="POST">
        @csrf
        <input type="hidden" name="financial_year" value="{{ $financial_year }}">
        <input type="hidden" name="employee_id" value="{{ $employee->id }}">




<!-- Income Tax Computation Table -->
<div class="table-container overflow-x-auto">
    <table id="incomeTaxTable" class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left">Sl. No.</th>
                <th class="px-4 py-2 text-left">Month</th>
                <th class="px-4 py-2 text-right">Basic Pay</th>
                <th class="px-4 py-2 text-right">DA</th>
                <th class="px-4 py-2 text-right">HRA</th>
                <th class="px-4 py-2 text-right">CCA</th>
                <th class="px-4 py-2 text-right">MA</th>
                <th class="px-4 py-2 text-right">PH</th>
                <th class="px-4 py-2 text-right">SFN</th>
                <th class="px-4 py-2 text-right">Other Allowances</th>
                
                <th class="px-4 py-2 text-right">Gross Salary</th>
                <th class="px-4 py-2 text-right">PT</th>
                <th class="px-4 py-2 text-right">LIC</th>
                <th class="px-4 py-2 text-right">GPF</th>
                <th class="px-4 py-2 text-right">GIS</th>
                <th class="px-4 py-2 text-right">KGID</th>
                <th class="px-4 py-2 text-right">IT</th>
                <th class="px-4 py-2 text-right">NPS</th>
                <th class="px-4 py-2 text-right">Others</th>
                <th class="px-4 py-2 text-right">Total Deduction</th>
                <th class="px-4 py-2 text-right">Net Salary</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totals = [
                    'basic_pay' => 0,
                    'da_amount' => 0,
                    'hra' => 0,
                    'cca_amount' => 0,
                    'ma' => 0,
                    'ph'=>0,
                    'sfa' => 0,
                    'other_allowance' => 0,
                   
                    'monthly_salary' => 0,
                    'pt' => 0,
                    'lic' => 0,
                    'gpf' => 0,
                    'gis' => 0,
                    'kgid' => 0,
                    'it' => 0,
                    'nps' => 0,
                    'others'=>0,
                    'total_deduction' => 0,
                    'net_amount' => 0,
                ];
            @endphp

            @foreach($data as $index => $row)
            <tr>
                <td class="px-4 py-2">{{ $index + 1 }}</td>
                <td class="px-4 py-2">{{ $row['month'] }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['basic_pay'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['da_amount'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['hra'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">
                            <input type="number" step="0.01" name="cca_amount[{{ $index }}]" 
                                value="{{ $row['cca_amount'] }}" 
                                class="w-24 border border-gray-300 rounded px-2 py-1 text-right">
                        </td>
                <!-- Editable MA Input -->
                <td class="px-4 py-2 text-right">
                            <input type="number" step="0.01" name="ma[{{ $index }}]" 
                                value="{{ $row['ma'] }}" 
                                class="w-24 border border-gray-300 rounded px-2 py-1 text-right">
                        </td>
                <td class="px-4 py-2 text-right">{{ number_format($row['ph'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['sfa'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['other_allowance'] ?? 0, 2) }}</td>
                
                <td class="px-4 py-2 text-right">{{ number_format($row['monthly_salary'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['pt'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['lic'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['gpf'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['gis'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['kgid'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['it'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['nps'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['others'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($row['total_deduction'] ?? 0, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format(($row['monthly_salary'] ?? 0) - ($row['total_deduction'] ?? 0), 2) }}</td>
            </tr>

            @php
                // Accumulate totals
                foreach ($totals as $key => &$total) {
                    $total += $row[$key] ?? 0;
                }
            @endphp
            @endforeach
        </tbody>
        <tfoot>
    <tr>
        <td colspan="2"><strong>Total</strong></td>
        <td id="total-basic-pay">{{ number_format($totals['basic_pay'], 2) }}</td>
        <td id="total-da">{{ number_format($totals['da_amount'], 2) }}</td>
        <td id="total-hra">{{ number_format($totals['hra'], 2) }}</td>
        <td id="total-cca">{{ number_format($totals['cca_amount'], 2) }}</td>
        <td id="total-ma">{{ number_format($totals['ma'], 2) }}</td>
        <td id="total-ph">{{ number_format($totals['ph'], 2) }}</td>
        <td id="total-sfa">{{ number_format($totals['sfa'], 2) }}</td>
        <td id="total-other-allowance">{{ number_format($totals['other_allowance'], 2) }}</td>

        <td id="total-monthly-salary">{{ number_format($totals['monthly_salary'], 2) }}</td>
        <td id="total-pt">{{ number_format($totals['pt'], 2) }}</td>
        <td id="total-lic">{{ number_format($totals['lic'], 2) }}</td>
        <td id="total-gpf">{{ number_format($totals['gpf'], 2) }}</td>
        <td id="total-gis">{{ number_format($totals['gis'], 2) }}</td>
        <td id="total-kgid">{{ number_format($totals['kgid'], 2) }}</td>
        <td id="total-it">{{ number_format($totals['it'], 2) }}</td>
        <td id="total-nps">{{ number_format($totals['nps'], 2) }}</td>
        <td id="total-others">{{ number_format($totals['others'], 2) }}</td>
        <td id="total-deduction">{{ number_format($totals['total_deduction'], 2) }}</td>
        <td id="total-net-salary">{{ number_format($totals['monthly_salary'] - $totals['total_deduction'], 2) }}</td>
    </tr>
</tfoot>

    </table>
</div>

<script>
    // Add event listeners to all editable inputs
    document.querySelectorAll('input[name^="cca_amount"], input[name^="ma"]').forEach(input => {
        input.addEventListener('input', updateTotals);
    });

    function updateTotals() {
        // Initialize total variables
        let totalBasicPay = 0, totalDA = 0, totalHRA = 0, totalCCA = 0, totalMA = 0;
        let totalPH = 0, totalSFA = 0, totalOtherAllowance = 0;
        let totalMonthlySalary = 0, totalDeduction = 0, totalNetSalary = 0;

        // Iterate through all rows to calculate totals
        document.querySelectorAll('#incomeTaxTable tbody tr').forEach(row => {
            const basicPay = parseFloat(row.children[2].textContent) || 0;
            const da = parseFloat(row.children[3].textContent) || 0;
            const hra = parseFloat(row.children[4].textContent) || 0;
            const cca = parseFloat(row.querySelector('input[name^="cca_amount"]').value) || 0;
            const ma = parseFloat(row.querySelector('input[name^="ma"]').value) || 0;
            const ph = parseFloat(row.children[7].textContent) || 0;
            const sfa = parseFloat(row.children[8].textContent) || 0;
            const otherAllowance = parseFloat(row.children[9].textContent) || 0;

            const monthlySalary = basicPay + da + hra + cca + ma + ph + sfa + otherAllowance;
            const deduction = parseFloat(row.children[10].textContent) || 0;

            totalBasicPay += basicPay;
            totalDA += da;
            totalHRA += hra;
            totalCCA += cca;
            totalMA += ma;
            totalPH += ph;
            totalSFA += sfa;
            totalOtherAllowance += otherAllowance;
            totalMonthlySalary += monthlySalary;
            totalDeduction += deduction;
            totalNetSalary += monthlySalary - deduction;
        });

        // Update footer totals
        document.getElementById('total-basic-pay').textContent = totalBasicPay.toFixed(2);
        document.getElementById('total-da').textContent = totalDA.toFixed(2);
        document.getElementById('total-hra').textContent = totalHRA.toFixed(2);
        document.getElementById('total-cca').textContent = totalCCA.toFixed(2);
        document.getElementById('total-ma').textContent = totalMA.toFixed(2);
        document.getElementById('total-ph').textContent = totalPH.toFixed(2);
        document.getElementById('total-sfa').textContent = totalSFA.toFixed(2);
        document.getElementById('total-other-allowance').textContent = totalOtherAllowance.toFixed(2);
        document.getElementById('total-monthly-salary').textContent = totalMonthlySalary.toFixed(2);
        document.getElementById('total-deduction').textContent = totalDeduction.toFixed(2);
        document.getElementById('total-net-salary').textContent = totalNetSalary.toFixed(2);
    }
</script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
       $(document).ready(function () {
    $('#incomeTaxTable').DataTable({
        responsive: true,
        paging: false, // Disable pagination
        info: false, // Disable entry info
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', className: 'btn btn-primary' },
            { extend: 'csvHtml5', className: 'btn btn-primary' },
            { extend: 'excelHtml5', className: 'btn btn-primary' },
            { extend: 'pdfHtml5', className: 'btn btn-primary' },
            { 
                extend: 'print',
                className: 'btn btn-primary',
                customize: function (win) {
                    $(win.document.body).find('table').addClass('print-table'); // Optional styling
                }
            },
        ],
    });
});


    </script>


@endsection
