<?php

namespace App\Http\Controllers;

use App\Models\FinancialSetting;
use Illuminate\Http\Request;

class FinancialSettingController extends Controller
{
    public function index()
    {
        $settings = FinancialSetting::all();
        // dd($settings);
        return view('settings.index', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }
    public function edit($id)
    {
        // Find the financial setting by its ID
        $setting = FinancialSetting::findOrFail($id);

        // Return the edit view with the setting data
        return view('settings.edit', compact('setting'));
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'financial_year' => 'required|string',
        'da_months' => 'nullable|array',
        'da_percentage' => 'nullable|array',
        'cca_amount' => 'required|numeric',
        'sfa'=>'required|numeric',
        'ma_amount' => 'required|numeric',
        'hra_rural' => 'required|numeric',
        'hra_city' => 'required|numeric',
        'hra_metro' => 'required|numeric',
        'other_allowance' => 'required|numeric',
    ]);

    // Prepare DA data as an associative array
    $da = [];
    if ($request->has('da_months') && is_array($request->da_months)) {
        foreach ($request->da_months as $month) {
            $da[$month] = $request->da_percentage[$month] ?? 0;
        }
    }

    // Ensure the DA array is properly encoded as JSON
    $daAmountJson = json_encode($da);

    \Log::info('DA Data: ', $da);

    // Store the financial settings in the database
    FinancialSetting::create([
        'financial_year' => $validatedData['financial_year'],
        'da_amount' => $daAmountJson,  // Store the JSON encoded DA array
        'cca_amount' => $validatedData['cca_amount'],
        'sfa'=>$validatedData['sfa'],
        'ma_amount' => $validatedData['ma_amount'],
        'hra_rural' => $validatedData['hra_rural'],
        'hra_city' => $validatedData['hra_city'],
        'hra_metro' => $validatedData['hra_metro'],
        'other_allowance' => $validatedData['other_allowance'],
    ]);
    \Log::info('Financial Setting Created: ', FinancialSetting::latest()->first()->toArray());


    return redirect()->route('settings.index')->with('success', 'Financial setting saved successfully.');
}
public function update(Request $request, $id)
{
    // Validate input
    $validated = $request->validate([
        'financial_year' => 'required|string|max:255',
        'da_amount' => 'nullable|array',
        'hra_rural' => 'nullable|numeric',
        'hra_city' => 'nullable|numeric',
        'hra_metro' => 'nullable|numeric',
        'cca_amount' => 'nullable|numeric',
        'sfa'=>'required|numeric',
        'ma_amount' => 'nullable|numeric',
        'other_allowance' => 'nullable|numeric',
    ]);

    // Find the financial setting by ID
    $setting = FinancialSetting::findOrFail($id);

    // Process DA Amount as JSON
    if (isset($validated['da_amount'])) {
        $validated['da_amount'] = json_encode($validated['da_amount']); // Convert array to JSON
    }

    // Update the setting
    $setting->update($validated);

    // Redirect back with success message
    return redirect()->route('settings.index')->with('success', 'Financial setting updated successfully!');
}

}
