<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\OfficeExpenseType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::today();
        $expenses = Expense::with('expenseType')->whereDate('date', $today)->get();
        $totalAmount = $expenses->sum('amount');
        $expenseTypes  = OfficeExpenseType::all();
        $cus_id = '';
        $emp_id = '';
        $location = '';
        return view('content.expenses.newexpenses', compact('expenses', 'expenseTypes', 'cus_id', 'emp_id', 'location', 'totalAmount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {

            $data = $request->validate([
                'expenses.*.expense_type_id' => 'required|exists:office_expense_types,id',
                'expenses.*.date' => 'required|date',
                'expenses.*.amount' => 'required|numeric',
                'expenses.*.description' => 'nullable|string',
                'expenses.*.location' => 'nullable|string',
            ]);

            if ($data['expenses']) {
                foreach ($data['expenses'] as $expense) {
                    Expense::create($expense);
                }

                return redirect()->route('expenses.create')->with('success', 'Expenses added successfully');
            } else {
                return redirect()->route('expenses.create')->with('error', 'Error');
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $expense = Expense::findOrFail($id);
            $expense->expense_type_id = $request->input('expense_type');
            $expense->date = $request->input('date');
            $expense->amount = $request->input('amount');
            $expense->description = $request->input('description');
            $expense->save();

            $expenseTypeName = $expense->expenseType->name;

            return response()->json([
                'message' => 'Expense updated successfully.',
                'expense_type_name' => $expenseTypeName,
            ]);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            Log::debug('Expense ID received for deletion: ' . $id);

            $expense = Expense::findOrFail($id);

            if (!$expense) {
                Log::error('Expense not found: ' . $id);
                return response()->json(['message' => 'Expense not found.'], 404);
            }

            $expense->delete();

            Log::info('Expense deleted successfully: ' . $id);

            return response()->json(['message' => 'Expense deleted successfully.']);
        } catch (Exception $e) {
        }
        Log::debug($e->getMessage());
    }
}
