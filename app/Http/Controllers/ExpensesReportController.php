<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\OfficeExpenseType;
use App\Models\Branch;
class ExpensesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

       try{

        #dd(session('user_data')->role);

        $location = session('user_data')->location;
        $role = session('user_data')->role;
        $locations = Branch::all();

        // Set default date range to current month
        $fromDate = $request->input('from_date', now()->startOfMonth()->toDateString());
        $toDate = $request->input('to_date', now()->endOfMonth()->toDateString());

        // Filter by selected expense type, if provided
        $expenseTypeId = $request->input('expense_type_id');

        // Initialize the query to get all columns, including the branch name
        $query = Expense::with(['expenseType', 'branch' => function($q) {
            $q->select('id', 'branch_name');
        }])->whereBetween('date', [$fromDate, $toDate]);

        // Check for the user's role and apply location filter if needed
        if (in_array($role, ['8', '9','10'])) {
            if ($request->filled('location') && $request->input('location') !== 'all') {
                $query->where('location', $request->input('location'));
            }
        } else {
            $query->where('location', $location);
        }

        // Filter by expense type if provided
        if ($expenseTypeId) {
            $query->where('expense_type_id', $expenseTypeId);
        }

        // Get the results without grouping, to include all columns
        $expenses = $query->get();


        // Calculate the grand total by summing the `amount` for the selected date range
        $grandTotal = $expenses->sum('amount');

        // For filter dropdowns
        $expenseTypes = OfficeExpenseType::where('status', 'Active')->get();

        // For filter dropdowns
        $expenseTypes = OfficeExpenseType::where('status', 'Active')->get();

        return view('content.expenses.report.index', compact('expenses', 'expenseTypes', 'fromDate', 'toDate', 'expenseTypeId', 'grandTotal', 'role', 'locations'));





       }catch(Exception $e){

       }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
