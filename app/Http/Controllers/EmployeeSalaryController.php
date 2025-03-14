<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSalary;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = EmployeeSalary::all();
        return view('employee_salaries.index', compact('salaries'));
    }

    public function create()
    {
        return view('employee_salaries.create');
    }

    public function store(Request $request)
    {
      $request->validate([
        'description' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'salary_month' => 'required|date',
        'added_by' => 'required|exists:users,id', // Ensure added_by is a valid user ID
    ]);

    EmployeeSalary::create($request->only('description', 'amount', 'salary_month', 'added_by'));

    return redirect()->route('employee_salaries.index')->with('success', 'Salary record created successfully.');
    }

    public function show(EmployeeSalary $employeeSalary)
    {
        return view('employee_salaries.show', compact('employeeSalary'));
    }

    public function edit(EmployeeSalary $employeeSalary)
    {
        return view('employee_salaries.edit', compact('employeeSalary'));
    }

    public function update(Request $request, EmployeeSalary $employeeSalary)
    {
      $request->validate([
        'description' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'salary_month' => 'required|date',
        'added_by' => 'required|exists:users,id',
    ]);

    $employeeSalary->update($request->only('description', 'amount', 'salary_month', 'added_by'));

    return redirect()->route('employee_salaries.index')->with('success', 'Salary record updated successfully.');
    }

    public function destroy(EmployeeSalary $employeeSalary)
    {
        $employeeSalary->delete();

        return redirect()->route('employee_salaries.index')->with('success', 'Salary record deleted successfully.');
    }
}
