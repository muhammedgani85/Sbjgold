<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\OfficeExpenseType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

       // Date Range Filter (if applied)
    $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date')) : null;
    $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date')) : null;

    $role = session('user_data')->role;
    $location = session('user_data')->location;
    $is_check = AttendanceController::check_role($role);
    if($is_check){


    $query = DB::table('expenses')
        ->join('office_expense_types', 'expenses.expense_type_id', '=', 'office_expense_types.id')
        ->select('expenses.*', 'office_expense_types.name as type_name')
        ->whereNull('expenses.deleted_at');
    }else{
      $query = DB::table('expenses')
        ->join('office_expense_types', 'expenses.expense_type_id', '=', 'office_expense_types.id')
        ->select('expenses.*', 'office_expense_types.name as type_name')
        ->where('location',$location)
        ->whereNull('expenses.deleted_at');


    }




    // Filter by date range if provided
    if ($startDate && $endDate) {
        $query->whereBetween('expenses.date', [$startDate, $endDate]);
    } else {
        // Default filter: Today's expenses
        $query->whereDate('expenses.date', Carbon::today());
    }

    $expenses = $query->get();

    // Calculate summaries
    $todayExpenses = DB::table('expenses')->whereDate('date', Carbon::today())->whereNull('expenses.deleted_at')->where('location',$location)->sum('amount');
    $yesterdayExpenses = DB::table('expenses')->whereDate('date', Carbon::yesterday())->whereNull('expenses.deleted_at')->where('location',$location)->sum('amount');
    $weekExpenses = DB::table('expenses')->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereNull('expenses.deleted_at')->where('location',$location)->sum('amount');
    $monthExpenses = DB::table('expenses')->whereMonth('date', Carbon::now()->month)->whereNull('expenses.deleted_at')->where('location',$location)->sum('amount');

    return view('content.expenses.index', compact('expenses', 'todayExpenses', 'yesterdayExpenses', 'weekExpenses', 'monthExpenses'));




    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = date('Y-m-d');


        $role = session('user_data')->role;
        $location = session('user_data')->location;
        $is_check = AttendanceController::check_role($role);
        if($is_check){
          $expenses = Expense::with('expenseType')->where('date', $today)->where('location',$location)->get();
        }else{
           $expenses = Expense::with('expenseType')->where('date', $today)->where('location',$location)->get();

        }

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


    public function list_expenses(){

      $expenses = OfficeExpenseType::where('status','Active')->get();

      return view('content.expenses.list_expenses',compact('expenses'));

    }


    public function new_expences(){



      return view('content.expenses.add_type');

    }


    public function new_expences_save(Request $request){
      try {

        $request->validate([
          'name' => 'required|string|max:255',
          'status' => 'required|string',

        ]);

        OfficeExpenseType::create($request->all());


       return redirect()->route('expenses.create')->with('success', 'Expenses added successfully');

    } catch (Exception $e) {
        Log::debug($e->getMessage());
    }
    }



    public function new_ex_update(Request $request, $id)
{
  $request->validate([
    'name' => 'required|string|max:255',
    'status' => 'required|string',

  ]);


    $expense = OfficeExpenseType::findOrFail($id);
    $expense->update($request->all());

    return redirect()->route('new_expences.index')->with('success', 'Expense updated successfully!');
}





}
