<?php

namespace App\Http\Controllers;
use App\Models\Employer;

use App\Models\Employee;
use App\Models\FinancialSetting;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index(Request $request)
{
    $query = Employee::query();

    // Apply search filters
    if ($request->has('search_name') && $request->search_name != '') {
        $query->where('employee_name', 'like', '%' . $request->search_name . '%');
    }

    if ($request->has('search_pan') && $request->search_pan != '') {
        $query->where('pan', 'like', '%' . $request->search_pan . '%');
    }

    // Paginate results
    $employees = $query->paginate(10);

    return view('employee.index', compact('employees'));
}


    /**
     * Show the form for creating a new employee.
     */
    public function create()
{
    $employers = Employer::all(); // Fetch all employers
    return view('employee.create', compact('employers'));
}

    /**
     * Store a newly created employee in the database.
     */

     public function store(Request $request)
     {
        //  \Log::info($request->all());

         // Validate the incoming request data
         $validatedData = $request->validate([
             'employee_name' => 'required|string|max:255',
             'employer_id' => 'nullable|exists:employers,id',
             'pan' => 'required|string|max:20|unique:employees',
             'basic_salary' => 'required|numeric',
             'location' => 'required|string', // 'rural', 'city', 'metro'
            //  'financial_year' => 'required|exists:financial_settings,financial_year', // Ensure valid financial year
             'pt' => 'nullable|numeric',
             'lic' => 'nullable|numeric',
             'gpf' => 'nullable|numeric',
             'gis'=>'nullable|numeric',
             'others'=>'nullable|numeric',
             'kgid'=>'nullable|numeric',
             'ph'=>'sometimes|boolean',
             'it'=>'nullable|numeric',
             'increment_month' => 'nullable|string',
             'increment_amount' => 'nullable|numeric',
             'pay_scale' => 'nullable|string',
             'payscale_change_month' => 'nullable|string',
            //  'payband' => 'nullable|string',
             'new_pay_scale' => 'nullable|string',
             'new_basic_salary' => 'nullable|numeric',
             'include_da' => 'sometimes|boolean',
             'include_cca' => 'sometimes|boolean',
             'include_ma' => 'sometimes|boolean',
             'include_personal_pay' => 'sometimes|boolean',
             'include_others' => 'sometimes|boolean',
             'include_nps' => 'sometimes|boolean',
         ]);

         // Initialize the employee instance
         $employee = new Employee();

         // Set values based on checkboxes
         $employee->employee_name = $validatedData['employee_name'];
         $employee->pan = $validatedData['pan'];
         $employee->employer_id=$validatedData['employer_id'];
         $employee->basic_salary = $validatedData['basic_salary'];
         $employee->location = $validatedData['location'];
        //  $employee->financial_year = $validatedData['financial_year'];
         $employee->pt = $validatedData['pt'] ?? null;
         $employee->lic = $validatedData['lic'] ?? null;
         $employee->gpf = $validatedData['gpf'] ?? null;
         $employee->gis = $validatedData['gis'] ?? null;
         $employee->kgid = $validatedData['kgid'] ?? null;
         $employee->it=$validatedData['it']??null;
         $employee->others = $validatedData['others'] ?? null;

         $employee->ph = $request->has('ph') ? true : false;

         $employee->increment_month = $validatedData['increment_month'] ?? null;
         $employee->increment_amount = $validatedData['increment_amount'] ?? null;
         $employee->pay_scale = $validatedData['pay_scale'] ?? null;
         $employee->payscale_change_month = $validatedData['payscale_change_month'] ?? null;
        //  $employee->payband = $validatedData['payband'] ?? null;
         $employee->new_pay_scale = $validatedData['new_pay_scale'] ?? null;
         $employee->new_basic_salary = $validatedData['new_basic_salary'] ?? null;

         // Handle checkbox values
         $employee->include_da = $request->has('include_da') ? true : false;
         $employee->include_cca = $request->has('include_cca') ? true : false;
         $employee->include_ma = $request->has('include_ma') ? true : false;
         $employee->include_personal_pay = $request->has('include_personal_pay') ? true : false;
         $employee->include_others = $request->has('include_others') ? true : false;
         $employee->include_nps = $request->has('include_nps') ? true : false; // Handle NPS checkbox

         // Save the employee record
         $employee->save();

         // Redirect back to the employee index page with a success message
         return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
     }

    /**
     * Show the specified employee details.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);


        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified employee in the database.
     */
    public function update(Request $request, $id)
    {
        // $employee = Employee::findOrFail($id);

        $validatedData = $request->validate([
            'include_nps' => 'nullable|boolean',
            'employee_name' => 'required|string|max:255',
            'pan' => 'required|string|max:20|unique:employees,pan,' . $id,
            'basic_salary' => 'required|numeric',
            'location' => 'required|string', // 'rural', 'city', 'metro'
            // 'financial_year' => 'required|exists:financial_settings,financial_year',
            'pt' => 'nullable|numeric',
            'lic' => 'nullable|numeric',
            'gpf' => 'nullable|numeric',
            'gis'=>'nullable|numeric',
            'others'=>'nullable|numeric',
            'it'=>'nullable|numeric',
            'kgid'=>'nullable|numeric',

            'increment_month' => 'nullable|string',
            'pay_scale' => 'nullable|string',
            'payscale_change_month' => 'nullable|string',
            // 'payband' => 'nullable|string',
            'new_pay_scale' => 'nullable|string',
            'new_basic_salary' => 'nullable|numeric',
            'include_cca' => 'sometimes|boolean',
    'include_ma' => 'sometimes|boolean',
    'include_personal_pay' => 'sometimes|boolean',
    'include_others' => 'sometimes|boolean',
        ]);
  // Set values based on checkboxes
  $validatedData['include_cca'] = $request->has('include_cca');
  $validatedData['include_ma'] = $request->has('include_ma');
  $validatedData['include_personal_pay'] = $request->has('include_personal_pay');
  $validatedData['include_others'] = $request->has('include_others');
        $employee->update($validatedData);
        $employee = Employee::findOrFail($id);
        $employee->include_nps = $request->has('include_nps') ? 1 : 0; // Set NPS based on checkbox
        $employee->save();
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified employee from the database.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
    }

    private function calculateMonthlySalaries($employee)
    {
        $salaries = [];
        $startMonth = 4; // Financial year starts in April
        $endMonth = 3; // Financial year ends in March (next year)
        $currentYear = date('Y', strtotime($employee->financial_year_start));
        $payScale = $employee->pay_scale;
        $basicSalary = $employee->basic_salary; // Starting basic salary
        $incrementMonth = $employee->increment_month; // Month when increment happens
        $incrementAmount = $employee->increment_amount; // Increment amount
        $payscaleChangeMonth = $employee->payscale_change_month; // Month when pay scale changes
        $newPayScale = $employee->new_pay_scale;
        $newBasicSalary = $employee->new_basic_salary;

        // Loop through all months of the financial year
        for ($month = $startMonth; $month <= 12; $month++) {
            $monthName = date("F", mktime(0, 0, 0, $month, 1));

            // Apply increment if it's the increment month
            if ($incrementMonth === $monthName && $incrementAmount) {
                $basicSalary += $incrementAmount;
            }

            // Update pay scale and basic salary if it's the pay scale change month
            if ($payscaleChangeMonth === $monthName) {
                if ($newPayScale) {
                    $payScale = $newPayScale;
                }
                if ($newBasicSalary) {
                    $basicSalary = $newBasicSalary;
                }
            }

            // Store salary details for the month
            $salaries[] = [
                'month' => $monthName,
                'pay_scale' => $payScale,
                'basic_salary' => $basicSalary,
            ];
        }

        // Loop through January to March of the next year
        for ($month = 1; $month <= $endMonth; $month++) {
            $monthName = date("F", mktime(0, 0, 0, $month, 1));

            // Apply increment if it's the increment month
            if ($incrementMonth === $monthName && $incrementAmount) {
                $basicSalary += $incrementAmount;
            }

            // Update pay scale and basic salary if it's the pay scale change month
            if ($payscaleChangeMonth === $monthName) {
                if ($newPayScale) {
                    $payScale = $newPayScale;
                }
                if ($newBasicSalary) {
                    $basicSalary = $newBasicSalary;
                }
            }

            // Store salary details for the month
            $salaries[] = [
                'month' => $monthName,
                'pay_scale' => $payScale,
                'basic_salary' => $basicSalary,
            ];
        }

        return $salaries;
    }

    public function showMonthlySalaries($employeeId)
{
    $employee = Employee::findOrFail($employeeId); // Replace with your actual model
    $salaries = $this->calculateMonthlySalaries($employee);
    return view('employee.monthly_salaries', compact('salaries', 'employee'));
}
private function calculateDA($basicSalary, $financialYear, $month)
{
    // Fetch the financial settings for the given financial year
    $financialSettings = FinancialSetting::where('financial_year', $financialYear)->first();

    // If no record is found, return 0 to avoid errors
    if (!$financialSettings) {
        return 0;
    }

    // Decode the DA JSON data to get the percentages for specific months
    $daData = json_decode($financialSettings->da_amount, true);

    // Check if the month exists in the DA data
    if (isset($daData[$month])) {
        // Get the DA percentage for the given month
        $daPercentage = (float) $daData[$month];
    } else {
        // If the month is not found, return 0 (or you could set a default percentage)
        return 0;
    }

    // Ensure basic salary is a float
    $basicSalary = (float) $basicSalary;

    // Calculate and return the DA amount
    return ($basicSalary * $daPercentage) / 100;
}

private function calculateHRA($basicSalary, $location)
{
    // Define HRA percentages based on location type
    $hraPercentages = [
        'rural' => 10,  // Rural areas
        'city' => 18,   // Cities
        'metro' => 24,  // Metro cities
    ];

    // Ensure the location matches one of the defined options
    $hraPercentage = (float) ($hraPercentages[$location] ?? 0);  // Cast to float

    // Ensure basic salary is a float
    $basicSalary = (float) $basicSalary;

    // Calculate and return the HRA amount
    return ($basicSalary * $hraPercentage) / 100;
}

public function incomeTaxComputation(Request $request)
{


    // Validate the request to ensure a financial year is provided
    $request->validate([
        'financial_year' => 'required|exists:financial_settings,financial_year', // Financial year must exist
    ]);

    $financialYear = $request->input('financial_year');
    $employeeId = $request->input('employee_id');  // Employee ID from form input


    // Fetch employee details
    $employee = Employee::findOrFail($employeeId);
    // Fetch financial settings for the provided financial year
    $financialSettings = FinancialSetting::where('financial_year', $financialYear)->first();

    // Check if financial settings are available
    if (!$financialSettings) {
        return redirect()->back()->withErrors('Financial settings not found for the selected financial year.');
    }

    // Calculate monthly salaries dynamically based on the employee details
    $monthlySalaries = $this->calculateMonthlySalaries($employee);

    $data = [];
    foreach ($monthlySalaries as $key => $salary) {
        $basicPay = $salary['basic_salary'];

        // Calculate DA per month for the employee
        $da = $this->calculateDA($salary['basic_salary'], $financialYear, $salary['month']);

        // Calculate HRA based on the employee's location and financial settings
        $hra = $this->calculateHRA($salary['basic_salary'], $employee->location, $financialSettings);

         // Calculate PH Allowance (6% of Basic Salary if PH is checked)
        //  $ph = $employee->ph ? ($employee->basic_salary * 6) / 100 : 0;
        // Fetch additional allowances based on checkboxes (include_* flags)


        $ma = $employee->include_ma ? (float) $financialSettings->ma_amount : 0;

        $ph = $employee->ph ? (float) ($salary['basic_salary'] * 6) / 100 : 0;
        // \Log::info('PH status: ' . $employee->ph . ', PH allowance: ' . $ph);
        $personalPay = $employee->include_personal_pay ? (float) $financialSettings->personal_pay_amount : 0;
        $other_allowance = $employee->include_others ? (float) $financialSettings->other_allowance : 0;

        // Only add CCA and DA if the employee has opted for them
        $cca = $employee->include_cca ? (float) $financialSettings->cca_amount : 0;
        $da = $employee->include_da ? $da : 0; // Using the DA calculated for the month

        // Fetch SFA from financial settings and set it to 0 if not applicable
        $sfa = $financialSettings->sfa ?? 0;

         // Calculate NPS: (Basic Pay + DA) * 10%
         $nps = $employee->include_nps ? ($basicPay + $da) * 0.10 : 0;

        // Calculate the monthly salary
        $monthlySalary = $basicPay + $da + $hra + $cca + $ma + $personalPay + $other_allowance + $sfa+$ph;

        // Calculate income tax based on the monthly salary
        $it = $employee->it;
        $gis=$employee->gis;
        $kgid=$employee->kgid;
        $it=$employee->it;
        $others=$employee->others;

        // Calculate total deductions (PT, LIC, GPF, Income Tax)
        $totalDeduction = $employee->pt + $employee->lic + $employee->gpf + $gis+$it+$others+$kgid+$nps;

        // Calculate net amount after deductions
        $netAmount = $monthlySalary - $totalDeduction;
        // \Log::info('PH status: ' . $employee->ph . ', PH allowance: ' . $ph);
        // Append data for this month
        $data[] = [
            'month' => $salary['month'],
            'basic_pay' => $basicPay,
            'da_amount' => $da,
            'hra' => $hra,
            'cca_amount' => $cca,
            'ma' => $ma,
            'sfa' => $sfa,
            'nps' => $nps,
            'other_allowance'=>$other_allowance,
            'ph'=>$ph,
            'personal_pay' => $personalPay,
            'others' => $others,
            'monthly_salary' => $monthlySalary,
            'pt' => $employee->pt,
            'lic' => $employee->lic,
            'gpf' => $employee->gpf,
            'gis' => $employee->gis,
            'kgid' => $employee->kgid,
            'it' => $employee->it,
            'total_deduction' => $totalDeduction,
            'net_amount' => $netAmount,
        ];
    }

    // Return the view with computed data and the selected financial year
    return view('employee.income_tax_computation', [
        'employee' => $employee,
        'financial_year' => $financialYear,
        'data' => $data,
    ]);
}


 // Show the income tax selection form
 public function showIncomeTaxSelectionForm()
 {
     // Fetch available financial years
     $financialYears = FinancialSetting::all(); // Adjust based on your data structure

     // Return the view with financial years
     return view('employee.income_tax_selection', compact('financialYears'));
 }

 // Compute income tax and show the results

// Add DA, HRA, and IT calculation helpers here...
// private function calculateIncomeTax($monthlySalary)
// {
//     // Annualize the monthly salary
//     $annualSalary = $monthlySalary * 12;

//     // Define income tax slabs (for illustration purposes, based on generic Indian tax slabs)
//     $taxSlabs = [
//         ['limit' => 250000, 'rate' => 0],   // No tax for income up to 2.5L
//         ['limit' => 500000, 'rate' => 5],  // 5% tax for income between 2.5L and 5L
//         ['limit' => 1000000, 'rate' => 20], // 20% tax for income between 5L and 10L
//         ['limit' => null, 'rate' => 30],   // 30% tax for income above 10L
//     ];

//     // Calculate income tax
//     $tax = 0;
//     $previousLimit = 0;

//     foreach ($taxSlabs as $slab) {
//         if ($slab['limit'] === null || $annualSalary > $slab['limit']) {
//             $tax += (($slab['limit'] ?? $annualSalary) - $previousLimit) * ($slab['rate'] / 100);
//             $previousLimit = $slab['limit'];
//         } else {
//             $tax += ($annualSalary - $previousLimit) * ($slab['rate'] / 100);
//             break;
//         }
//     }

//     // Divide the annual tax by 12 to get monthly income tax
//     return round($tax / 12, 2);
// }


}
