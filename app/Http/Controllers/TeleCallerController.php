<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Customer;
use App\Models\Branch;
use App\Models\TelecallerReason;
use Carbon\Carbon;

use DB;

class TeleCallerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        try{

          $locationId = session('user_data')->location;
          $role = session('user_data')->role;

          // Define filter options
          $fromDate = $request->input('from_date', now()->startOfMonth()->toDateString());
          $toDate = $request->input('to_date', now()->endOfMonth()->toDateString());
          $branchId = $request->input('branch_id');
          $branches = Branch::all();

          // Initialize the query to find customers with loans
          $query = DB::table('loans')
          ->select(
            'customers.id as cust_id',
            'customers.first_name',
            'customers.last_name',
            'customers.phone_number',
            'customers.email_id',
            'branches.branch_name',
            'loans.created_at as loan_created_date',
            'loans.loan_number' // Include loan number to find payments
          )
          ->join('customers', 'loans.customer_id', '=', 'customers.id')
          ->join('branches', 'customers.location_id', '=', 'branches.id')
          ->whereBetween('loans.created_at', [$fromDate, $toDate]); // Filter loans by creation date

          // Apply branch filter
          if ($branchId && $branchId !== 'all') {
          $query->where('customers.location_id', $branchId);
          } else {
          // If 'all' is selected, no additional branch filter is needed
          // The default behavior will include all branches
          }

          // Execute the query and fetch results
          $loans = $query->get();

          // Prepare an array to hold customer data with unpaid months
          $customerData = [];

          foreach ($loans as $loan) {
          // Get the loan created date
          $loanCreatedDate = Carbon::parse($loan->loan_created_date);
          // Create an array of months from loan created date to now
          $months = [];
          for ($month = $loanCreatedDate->month; $month <= now()->month; $month++) {
            $months[] = $month; // Add each month to the array
          }

          // Fetch the months for which interest has been paid
          $paidMonths = DB::table('loan_interest_payments')
            ->where('loan_id', $loan->loan_number)
            ->pluck('month') // Get the months where payments have been made
            ->toArray();

          // Find unpaid months
          $unpaidMonths = array_diff($months, $paidMonths);

          // Add customer info along with unpaid months if any
          if (!empty($unpaidMonths)) {
            $customerData[] = [
                'cust_id' =>$loan->cust_id,
                'first_name' => $loan->first_name,
                'last_name' => $loan->last_name,
                'phone_number' => $loan->phone_number,
                'email_id' => $loan->email_id,
                'branch_name' => $loan->branch_name,
                'loan_created_date' => $loan->loan_created_date,
                'unpaid_months' => $unpaidMonths,// Store unpaid months
                'loan_number' => $loan->loan_number
            ];
          }



}



}catch(Exception $e){

}

// Return view with customer data
#dd($customerData);
$reasons = TelecallerReason::where('status','Active')->get();
return view('content.telecaller.index', compact('customerData', 'fromDate', 'toDate', 'branchId', 'branches','reasons'));




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
