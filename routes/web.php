<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FinancialSettingController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\EmployerController;



// Home route (optional, replace with your desired landing page)
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (middleware ensures only authenticated users access these)
Route::middleware(['auth'])->group(function () {

      // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route::get('/employee/income-tax-selection', [EmployeeController::class, 'showFinancialYearSelectionForm'])->name('employee.income_tax_selection');

    // Employer Routes
    Route::prefix('employer')->name('employer.')->group(function () {
        Route::get('/', [EmployerController::class, 'index'])->name('index');
        Route::get('/create', [EmployerController::class, 'create'])->name('create');
        Route::post('/', [EmployerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [EmployerController::class, 'edit'])->name('edit');
        Route::put('/employer/{id}', [EmployerController::class, 'update'])->name('employer.update');
        Route::put('/{id}', [EmployerController::class, 'update'])->name('update'); // Ensure this line exists

        Route::delete('/{id}', [EmployerController::class, 'destroy'])->name('destroy');
    });


// Employee routes

Route::prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employee.index'); // List employees
    Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create'); // Show create form
    Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store'); // Store new employee
    Route::get('/{id}/show', [EmployeeController::class, 'show'])->name('employee.show'); // Show employee details
    Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit'); // Show edit form
    Route::put('/{id}/update', [EmployeeController::class, 'update'])->name('employee.update'); // Update employee
    Route::delete('/{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.destroy'); // Delete employee
});

// Financial Settings routes
Route::prefix('settings')->group(function () {
    Route::get('/', [FinancialSettingController::class, 'index'])->name('settings.index'); // List financial settings
    Route::get('/create', [FinancialSettingController::class, 'create'])->name('settings.create'); // Show create form
    Route::post('/store', [FinancialSettingController::class, 'store'])->name('settings.store'); // Store new settings
    Route::get('/{id}/edit', [FinancialSettingController::class, 'edit'])->name('settings.edit'); // Show edit form
    Route::put('/{id}/update', [FinancialSettingController::class, 'update'])->name('settings.update'); // Update settings
    Route::get('financial-settings/{id}/edit', [FinancialSettingController::class, 'edit'])->name('financial-settings.edit');

    Route::delete('/{id}/delete', [FinancialSettingController::class, 'destroy'])->name('settings.destroy'); // Delete settings
});



Route::get('/employees/{id}/salaries', [EmployeeController::class, 'showMonthlySalaries'])->name('employees.salaries');

// Route::get('/employee/{employeeId}/salary', [SalaryController::class, 'computeSalary'])->name('salary.compute');
// Route::get('/employee/{id}/income-tax', [EmployeeController::class, 'incomeTaxComputation'])->name('employee.income_tax');
// Route for displaying the financial year selection form

Route::get('/employee/{employeeId}/salary', [SalaryController::class, 'computeSalary'])->name('salary.compute');


// routes/web.php
// Route to show the financial year selection form
Route::get('/employee/income-tax-selection', [EmployeeController::class, 'showIncomeTaxSelectionForm'])
    ->name('employee.income_tax_selection');

// Route to handle the form submission and compute income tax
Route::post('/employee/income-tax-computation', [EmployeeController::class, 'incomeTaxComputation'])
    ->name('income_tax_compute');

});
