<!-- resources/views/employee/salary_details.blade.php -->

<table>
    <thead>
        <tr>
            <th>Month</th>
            <th>Basic Salary</th>
            <th>HRA Amount</th>
            <th>DA Amount</th>
            <th>Total Salary</th>
        </tr>
    </thead>
    <tbody>
        @foreach($daDetails as $detail)
            <tr>
                <td>{{ $detail['month'] }}</td>
                <td>{{ $detail['basic_salary'] }}</td>
                <td>{{ $detail['hra_amount'] }}</td>
                <td>{{ $detail['da_amount'] }}</td>
                <td>{{ $detail['total_salary'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
