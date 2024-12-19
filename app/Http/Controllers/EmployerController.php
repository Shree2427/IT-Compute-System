<?php
namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class EmployerController extends Controller
{
    // Show the form to add a new employer
    public function create()
    {
        return view('employer.create');
    }

    // Store new employer information in the database
    public function store(Request $request)
    {
        $request->validate([
            'tan' => 'required|string|max:10',
            'name_of_institute' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pincode' => 'required|string|max:6',
            'name_of_ddo' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'employer_pan' => 'required|string|max:10',
        ]);

        Employer::create($request->all());

        return redirect()->route('employer.index')->with('success', 'Employer added successfully!');
    }

    // Display list of employers (optional)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $employers = Employer::when($search, function ($query, $search) {
            // Get all columns of the 'employers' table
            $columns = Schema::getColumnListing('employers');

            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%$search%");
            }
        })->paginate(10);

        return view('employer.index', compact('employers'));
    }


    // Show the form for editing an employer
    public function edit($id)
    {
        $employer = Employer::findOrFail($id);
        return view('employer.edit', compact('employer'));
    }

    // Update an employer in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'tan' => 'required|string|max:10',
            'name_of_institute' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pincode' => 'required|string|max:6',
            'name_of_ddo' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'employer_pan' => 'required|string|max:10',
        ]);

        $employer = Employer::findOrFail($id);
        $employer->update($request->all());

        return redirect()->route('employer.index')->with('success', 'Employer updated successfully!');
    }

    // Destroy an employer (optional)
    public function destroy($id)
    {
        Employer::findOrFail($id)->delete();
        return redirect()->route('employer.index')->with('success', 'Employer deleted successfully!');
    }
}
