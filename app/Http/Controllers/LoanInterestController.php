<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\LoanInterest;
use App\Models\InterestPaymentModel;
use App\Models\Loan;
use App\Models\LoanInterstModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class LoanInterestController extends Controller
{
  public function index()
  {
    $loanInterests = LoanInterest::with('loanType')->get();

      return view('content.loan_interests.index', compact('loanInterests'));
  }

  public function create()
  {
      return view('content.loan_interests.create');
  }

  public function store(Request $request)
  {

       // dd($request->all());
        $request->validate([
        'type' => 'required',
        'interest_rate' => 'required',
        'interest_percentage' => 'required|numeric',
        'per_gram_amount' => 'required',
        'months' => 'required',
        ]);
        LoanInterstModel::create($request->all());

        return response()->json(['success' => 'New Interest Added successfully.']);
  }

  public function edit(string $id){


    $loanInterests = LoanInterstModel::findOrFail($id);
    return view('content.loan_interests.edit',compact('loanInterests'));
  }


  public function update(Request $request, string $id)
  {

       // dd($request->all());
       $request->validate([
        'type' => 'required|string|max:255',
        'interest_rate' => 'required|numeric',
        'interest_percentage' => 'required|numeric',
        'per_gram_amount' => 'required|numeric',
        'months' => 'required|numeric',
        'document_charge' => 'required|numeric',
    ]);

    // Find the record by ID
    $loanInterest = LoanInterstModel::findOrFail($id);

    // Update the record
    $loanInterest->update($request->all());

    // Return a JSON response
    return response()->json([
        'success' => true,
        'message' => 'Loan interest details updated successfully.'
    ]);

  }



  public function paidInterest(Request $request)
  {

      //  dd($request->all());
        $request->validate([
        'loan_number' => 'required',
        'payment_month' => 'required',
        'payment_amount' => 'required',
        'payment_method' => 'required',

        ]);
        //LoanInterstModel::create($request->all());
        DB::insert("INSERT INTO loan_interest_payments (loan_id, month, interest_amount, payment_method, user_id, location,created_at, updated_at)
        VALUES (?, ?, ?, ?, ?,?, NOW(), NOW())", [
        $request->loan_number,
        $request->payment_month,
        $request->payment_amount,
        $request->payment_method,
        session('user_data')->id,
        session('user_data')->location
        ]);


        return response()->json(['success' => 'New Interest Added successfully.']);
  }


  // Share Holder Bank Interest paid

  public function otherPaidInterest(Request $request)
  {

      //  dd($request->all());
        $request->validate([
        'loan_number' => 'required',
        'payment_month' => 'required',
        'payment_amount' => 'required',
        'payment_method' => 'required',

        ]);
        //LoanInterstModel::create($request->all());
        DB::insert("INSERT INTO other_bank_interest_payments (loan_id, month, interest_amount, payment_method, user_id, location,created_at, updated_at)
        VALUES (?, ?, ?, ?, ?,?, NOW(), NOW())", [
        $request->loan_number,
        $request->payment_month,
        $request->payment_amount,
        $request->payment_method,
        session('user_data')->id,
        session('user_data')->location
        ]);


        return response()->json(['success' => 'New Interest Added successfully.']);
  }


  public function interestReport(Request $request){

    $role = session('user_data')->role;
    $location = session('user_data')->location;

    // Fetch distinct loan statuses
    $loan_status = Loan::distinct()->pluck('status');
    $branch = Branch::where('status', 'Active')->get();

    $is_check = AttendanceController::check_role($role);

    // Initialize the query
    $query = InterestPaymentModel::query();

    // Apply location filter (Only non-admin users)
    if (!$is_check) {
        $query->where('location', $location);
    }

    // Apply loan status filter if selected
    if ($request->filled('loan_status')) {
        $query->where('status', $request->loan_status);
    }


    if ($request->filled('location')) {
      $query->where('location', $request->location);
  }

    // Apply date range filter if selected
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('created_at', [
            Carbon::parse($request->from_date)->startOfDay(),
            Carbon::parse($request->to_date)->endOfDay()
        ]);
    }

    // Fetch filtered data
    $inrest_Reports = $query->get();

    return view('content.loan.loan_interest_report', compact('inrest_Reports', 'loan_status', 'branch', 'role'));
}







}
