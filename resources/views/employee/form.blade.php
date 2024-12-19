<!-- resources/views/employee/form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee</title>

    <!-- Bootstrap CSS for Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for Styling -->
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
            font-size: 2rem;
            margin-bottom: 30px;
            text-align: center;
        }
        label {
            font-weight: bold;
            color: #495057;
        }
        input[type="text"],
        input[type="number"],
        select,
        .form-check-input {
            border-radius: 4px;
            border: 1px solid #007bff;
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
            transition: border 0.3s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus,
        .form-check-input:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 91, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            font-size: 1rem;
            width: 100%;
            margin-top: 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-check-label {
            color: #495057;
            font-weight: normal;
        }
        .form-check {
            margin-left: 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Create Employee</h1>
        <form action="{{ route('employee.store') }}" method="POST">
            @csrf

            <!-- Employee Name -->
            <div class="mb-3">
                <label for="employee_name" class="form-label">Employee Name:</label>
                <input type="text" id="employee_name" name="employee_name" class="form-control" required>
            </div>

            <!-- Employee PAN -->
            <div class="mb-3">
                <label for="pan" class="form-label">PAN:</label>
                <input type="text" id="pan" name="pan" class="form-control" required>
            </div>

            <!-- Basic Salary -->
            <div class="mb-3">
                <label for="basic_salary" class="form-label">Basic Salary:</label>
                <input type="number" id="basic_salary" name="basic_salary" class="form-control" step="0.01" required>
            </div>

            <!-- HRA Options -->
            <div class="mb-3">
                <label class="form-label">Select Area Type for HRA:</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="hra_type[]" value="rural">
                    <label class="form-check-label" for="hra_type">Rural (10%)</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="hra_type[]" value="city">
                    <label class="form-check-label" for="hra_type">City (18%)</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="hra_type[]" value="metro">
                    <label class="form-check-label" for="hra_type">Metro (24%)</label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS for Modal, Tooltip, etc. (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
