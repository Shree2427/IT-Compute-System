<?php
// app/Http/Controllers/SalaryController.php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\FinancialSetting;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function computeSalary($employeeId)
    {
        // Fetch employee data
        $employee = Employee::findOrFail($employeeId);
    
        // Fetch financial settings for the corresponding financial year
        $settings = FinancialSetting::where('financial_year', $employee->financial_year)->first();
    
        // Ensure $settings is found before proceeding
        if (!$settings) {
            return redirect()->back()->withErrors('Financial settings not found for the selected financial year.');
        }
    
        // Initialize DA (Dearness Allowance)
        $da = 0;
    
        // Ensure increment_month is a valid string representing the month
        if ($employee->increment_month >= 'January' && $employee->increment_month <= 'June') {
            // Assign DA for Jan to June period
            $da = $settings->da1;
        } elseif ($employee->increment_month >= 'July' && $employee->increment_month <= 'December') {
            // Assign DA for July to Dec period
            $da = $settings->da2;
        }
    
        // Log DA value to verify it's being set
        \Log::info('Calculated DA: ' . $da);
    
        // Calculate HRA based on location
        $hra = 0;
        switch ($employee->location) {
            case 'rural':
                $hra = ($employee->basic_salary * $settings->hra_rural) / 100;
                break;
            case 'city':
                $hra = ($employee->basic_salary * $settings->hra_city) / 100;
                break;
            case 'metro':
                $hra = ($employee->basic_salary * $settings->hra_metro) / 100;
                break;
            default:
                $hra = 0;
                break;
        }
    
        // Other allowances
        $cca = $settings->cca_amount ?? 0;
        $ma = $settings->ma_amount ?? 0;
        $sfa = $settings->sfa ?? 0;
        $otherAllowance = $settings->other_allowance ?? 0;
    
        // Deductions (example: PT, LIC, GPF, etc.)
        $pt = $employee->pt;
        $lic = $employee->lic;
        $gpf = $employee->gpf;
        $gis = $employee->gis;
        $others = $employee->others;
        $kgid = $employee->kgid;
        $it = $employee->it;
    
        // Calculate PH Allowance (6% of Basic Salary if PH is checked)
        $phAllowance = $employee->ph ? ($employee->basic_salary * 6) / 100 : 0;
    
        // Log PH Allowance value
        \Log::info('PH Allowance: ' . $phAllowance);
    
        // Gross Salary = Basic Salary + Allowances (HRA + DA + CCA + MA + Other Allowances + PH Allowance)
        $grossSalary = $employee->basic_salary + $hra + $da + $cca + $ma + $otherAllowance + $sfa + $phAllowance;
    
        // Total Deductions = PT + LIC + GPF + GIS + Others + KGID + IT
        $totalDeductions = $pt + $lic + $gpf + $gis + $others + $kgid + $it;
    
        // Net Salary = Gross Salary - Deductions
        $netSalary = $grossSalary - $totalDeductions;
    
        // Return to a view with computed salary details
        return view('salary.show', compact(
            'employee',
            'grossSalary',
            'totalDeductions',
            'netSalary',
            'da',
            'hra',
            'cca',
            'ma',
            'sfa',
            'otherAllowance',
            'phAllowance'
        ));
    }
    
    private function calculateMonthlySalaries($employee)
    {
        $salaries = [];
        $startMonth = 4; // Financial year starts in April
        $endMonth = 3; // Financial year ends in March (next year)
        $payScale = $employee->pay_scale;
        $basicSalary = $employee->basic_salary; // Starting basic salary
        $incrementMonth = $employee->increment_month; // Month when increment happens
        $incrementAmount = $employee->increment_amount; // Increment amount
        $payscaleChangeMonth = $employee->payscale_change_month; // Month when pay scale changes
        $newPayScale = $employee->new_pay_scale;
        $newBasicSalary = $employee->new_basic_salary;
    
        // Fetch financial year settings
        $financialSettings = FinancialSetting::where('financial_year', $employee->financial_year)->first();
    
        if (!$financialSettings) {
            \Log::error('Financial settings not found for year ' . $employee->financial_year);
            return [];
        }
    
        $daJanToJune = $financialSettings->da1; // DA percentage for Jan–June
        $daJulyToDec = $financialSettings->da2; // DA percentage for July–Dec
    
        \Log::info('DA1: ' . $daJanToJune . ', DA2: ' . $daJulyToDec);
    
        // Loop through all months of the financial year
        for ($month = $startMonth; $month <= 12; $month++) {
            $monthName = date("F", mktime(0, 0, 0, $month, 1));
    
            \Log::info('Processing Month: ' . $monthName);
    
            // Apply increment if it's the increment month
            if ($incrementMonth === $monthName && $incrementAmount) {
                $basicSalary += $incrementAmount;
                \Log::info('Increment applied. New Basic Salary: ' . $basicSalary);
            }
    
            // Update pay scale and basic salary if it's the pay scale change month
            if ($payscaleChangeMonth === $monthName) {
                if ($newPayScale) {
                    $payScale = $newPayScale;
                    \Log::info('Pay scale changed to: ' . $payScale);
                }
                if ($newBasicSalary) {
                    $basicSalary = $newBasicSalary;
                    \Log::info('Basic salary changed to: ' . $basicSalary);
                }
            }
    
            // Determine DA percentage based on month
            $daPercentage = ($month >= 1 && $month <= 6) ? $daJanToJune : $daJulyToDec;
    
            // Calculate DA
            $da = ($basicSalary * $daPercentage) / 100;
            \Log::info('DA calculated for ' . $monthName . ': ' . $da);
    
            // Store salary details for the month
            $salaries[] = [
                'month' => $monthName,
                'pay_scale' => $payScale,
                'basic_salary' => $basicSalary,
                'da' => round($da, 2), // Rounded DA for precision
            ];
        }
    
        // Loop through January to March of the next year
        for ($month = 1; $month <= $endMonth; $month++) {
            $monthName = date("F", mktime(0, 0, 0, $month, 1));
    
            \Log::info('Processing Month: ' . $monthName);
    
            // Apply increment if it's the increment month
            if ($incrementMonth === $monthName && $incrementAmount) {
                $basicSalary += $incrementAmount;
                \Log::info('Increment applied. New Basic Salary: ' . $basicSalary);
            }
    
            // Update pay scale and basic salary if it's the pay scale change month
            if ($payscaleChangeMonth === $monthName) {
                if ($newPayScale) {
                    $payScale = $newPayScale;
                    \Log::info('Pay scale changed to: ' . $payScale);
                }
                if ($newBasicSalary) {
                    $basicSalary = $newBasicSalary;
                    \Log::info('Basic salary changed to: ' . $basicSalary);
                }
            }
    
            // Determine DA percentage based on month
            $daPercentage = ($month >= 1 && $month <= 6) ? $daJanToJune : $daJulyToDec;
    
            // Calculate DA
            $da = ($basicSalary * $daPercentage) / 100;
            \Log::info('DA calculated for ' . $monthName . ': ' . $da);
    
            // Store salary details for the month
            $salaries[] = [
                'month' => $monthName,
                'pay_scale' => $payScale,
                'basic_salary' => $basicSalary,
                'da' => round($da, 2), // Rounded DA for precision
            ];
        }
    
        return $salaries;
    }
    

}
