<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\LoanInterest;
use App\Models\LoanRelease;
use App\Models\LoanType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{



  public function index()
  {
    $location = session('user_data')->location;

    $loans = Loan::with(['loanType', 'location', 'customer'])->orderBy('id', 'DESC')->where('location_id', $location)->get();

    $totalLoan = $loans->count();

    // Count customers added today
    $todayLoans = $loans->where('created_at', '>=', Carbon::today())->count();

    // Count customers added this week
    $weekLoans = $loans->where('created_at', '>=', Carbon::now()->startOfWeek())->count();

    // Count customers added this month
    $monthLoans = $loans->where('created_at', '>=', Carbon::now()->startOfMonth())->count();


    return view('content.loan.index', compact('loans', 'todayLoans', 'weekLoans', 'monthLoans'));
  }


  public function create()
  {

    $location = session('user_data')->location;
    $loan_type = LoanType::where('status','Active')->get();


    $branch = LoanType::find(1);
    $interest = LoanInterest::where('status','1')->get();


    // Count the number of loans for this location
    $loanCount = Loan::where('location_id', $location)->count();
    $loanNumber = "SJ-".$branch->loan_prefix . '-' . str_pad($loanCount + 1, 5, '0', STR_PAD_LEFT);

       $customer = Customer::where('status','Active')->where('location_id',$location)->get();
     /* $loanTypes = LoanType::where('status', true)->get(); */
      return view('content.loan.create',compact('customer','loan_type','loanNumber','interest','location'));
  }

  public function store(Request $request)
  {
        // Store Feature
  }

  public function show($id)
  {
      $loan = Loan::with('customer', 'loanType')->findOrFail($id);
      return view('loans.show', compact('loan'));
  }


  public function getCustomerInfo(Request $request)
{
    $customer = Customer::where('id', $request->customer_number)->first();

    if ($customer) {
        return response()->json(['status' => 'success', 'data' => $customer]);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Customer not found']);
    }
}

public function generateLoanNumber($locationId)
{
    $branch = LoanType::find($locationId);

    $location = session('user_data')->location;
    // Count the number of loans for this location
    $loanCount = Loan::where('location_id', $location)->count();
    $loanNumber = "SJ-".$branch->loan_prefix . '-' . str_pad($loanCount + 1, 5, '0', STR_PAD_LEFT);

    return response()->json(['loan_number' => $loanNumber]);
}


public function fetchInterestDetails(Request $request)
    {
        $interestTypeId = $request->input('interest_type_id');
        $loanInterest = LoanInterest::find($interestTypeId);

        if ($loanInterest) {
            return response()->json([
                'per_gram_amount' => $loanInterest->per_gram_amount,
                'months' => $loanInterest->months,
                'interest_rate' => $loanInterest->interest_rate,
                'interest_percentage' => $loanInterest->interest_percentage,
                'loanAmount' => $loanInterest->per_gram_amount * $loanInterest->months,
                'document_charge' =>$loanInterest->document_charge,

            ]);
        } else {
            return response()->json(['error' => 'Interest type not found'], 404);
        }
    }

    public function fetchLoanDetails(Request $request)
    {
        $loanTypeId = $request->input('loan_type_id');
        $locationId = session('user_data')->location;
        $branch = LoanType::find($loanTypeId);


        // Fetch loan interests based on loan type
        $interests = LoanInterest::where('loan_type_id', $loanTypeId)->get();

        // Generate loan number based on location
        $lastLoan = Loan::where('location_id', $locationId)->orderBy('id', 'desc')->first();
        $nextLoanNumber = $lastLoan ? ((int) substr($lastLoan->loan_number, -5)) + 1 : 1;
        $loanNumber = 'SJ-' .$branch->loan_prefix.'-'. str_pad($nextLoanNumber, 5, '0', STR_PAD_LEFT);

        return response()->json([
            'interests' => $interests,
            'loan_number' => $loanNumber
        ]);
    }

    public function calculateLoanAmounts(Request $request)
    {
        $loanAmount = $request->input('total_loan_amount');
        $interestRate = LoanInterest::find($request->input('interest_type_id'))->interest_rate;
        $months = LoanInterest::find($request->input('interest_type_id'))->months;

        $totalInterestAmount = $loanAmount * ($interestRate / 100) * ($months / 12);
        $perMonthPayableAmount = ($loanAmount + $totalInterestAmount) / $months;

        return response()->json([
            'total_interest_amount' => number_format($totalInterestAmount, 2),
            'per_month_payable_amount' => number_format($perMonthPayableAmount, 2)
        ]);
    }


    public function customer_details() {


      return view('content.loan.cdetail');
    }

    public function saveLoan(Request $request)
    {

      $user_id = session('user_data')->id;

        $validated = $request->validate([
            'loan_type' => 'required|integer',
            'loan_number' => 'required|string',
            'interest_type_id' => 'required|integer',
            'jewel_net_grams' => 'nullable|numeric',
            'jewel_grams' => 'nullable|numeric',
            'total_loan_amount' => 'required|numeric',
            'total_interest_amount' => 'required|numeric',
            'per_month_payable_amount' => 'required|numeric',
            'total_include_int_amount' => 'required|numeric',
            'document_charge' => 'required|numeric',
            'customer_photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'customer_other' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {

            if(isset($request->loan_type)){

              $loan_type_details = LoanInterest::where('id',$request->interest_type_id)->first();
              $loan_interest_percentage =$loan_type_details->interest_percentage;
              $per_gram_amount =$loan_type_details->per_gram_amount;
              $loan_month =$loan_type_details->months;
            }

            $loan = new Loan();
            $loan->customer_id = $request->input('customer_number', NULL);
            $loan->loan_type_id = $request->input('loan_type', NULL);
            $loan->loan_number = $request->input('loan_number', NULL);
            $loan->interest_type_id = $request->input('interest_type_id', NULL);
            $loan->jewel_net_grams = $request->input('jewel_net_grams', NULL);
            $loan->jewel_grams = $request->input('jewel_grams', NULL);
            $loan->total_loan_amount = $request->input('total_loan_amount', NULL);
            $loan->total_interest_amount = $request->input('total_interest_amount', NULL);
            $loan->per_month_payable_amount = $request->input('per_month_payable_amount', NULL);
            $loan->total_include_int_amount = $request->input('total_include_int_amount', NULL);
            $loan->document_charge = $request->input('document_charge', NULL);
            $loan->location_id = $request->input('location_id', NULL);
            $loan->interest_per = isset($loan_interest_percentage)?$loan_interest_percentage:0;
            $loan->interest_month = isset($loan_month)?$loan_month:0;
            $loan->pergram_amount = isset($per_gram_amount)?$per_gram_amount:0;
            $loan->added_by = $user_id;



            if ($request->hasFile('customer_photo')) {
              $loan->customer_photo = $request->file('customer_photo')->store('photos', 'public');
          }

          if ($request->hasFile('customer_other')) {
            $loan->customer_other = $request->file('customer_other')->store('documents', 'public');
          }

            $loan->save();
            DB::commit();

            return response()->json(['message' => 'Loan saved successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Error saving loan: ' . $e->getMessage()], 500);
        }
      }


  public function approval(){
    try{
          $loans = Loan::with(['customer', 'loanType'])->where('status','New')->get();
          return view('content.loan.approval', compact('loans'));
    }catch (\Exception $e) {
          return response()->json(['message' => 'Error saving loan: ' . $e->getMessage()], 500);
    }

  }


    public function approvalview($loan_number){
      try{
        $loan = Loan::with(['customer', 'loanType'])->where('loan_number', $loan_number)->first();
       return view('content.loan.approvalview', compact('loan'));
      }catch (\Exception $e) {


        return response()->json(['message' => 'Error saving loan: ' . $e->getMessage()], 500);
    }

    }


    public function updateLoanStatus(Request $request)
{
    // Validate request
    $validated = $request->validate([
        'loan_number' => 'required|string',
        'status' => 'required|string'
    ]);

    // Find the loan
    $loan = Loan::where('loan_number', $request->loan_number)->first();

    if ($loan) {
        $loan->status = $request->status;
        $loan->approved_by = session('user_data')->id;
        $loan->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    return response()->json(['message' => 'Loan not found'], 404);
}


public function dispatch(){


  try{
    $loans = Loan::with(['customer', 'loanType'])->where('status','Approved')->get();
    return view('content.loan.dispatch', compact('loans'));
  }catch (\Exception $e) {


    return response()->json(['message' => 'Error saving loan: ' . $e->getMessage()], 500);
}


}


  public function dispatchview($loan_number){
      try{
          $loan = Loan::with(['customer', 'loanType'])->where('loan_number', $loan_number)->first();
          return view('content.loan.dispatchview', compact('loan'));
      }catch (\Exception $e) {
          return response()->json(['message' => 'Error saving loan: ' . $e->getMessage()], 500);
      }

  }

  public function updateLoanDispatchStatus(Request $request)
  {
      // Validate request
      $validated = $request->validate([
          'loan_number' => 'required|string',
          'status' => 'required|string'
      ]);

      // Find the loan
      $loan = Loan::where('loan_number', $request->loan_number)->first();

      if ($loan) {
          $loan->status = $request->status;
          $loan->approved_by = session('user_data')->id;
          $loan->save();

          return response()->json(['message' => 'Status updated successfully']);
      }

      return response()->json(['message' => 'Loan not found'], 404);
  }


  public function releaseLoan(Request $request){

    //dd($request->all());


     // Validate incoming data
    $validated = $request->validate([
      'release_customerName' => 'required|string',
      'release_loanNumber' => 'required|string',
      'release_loanAmount' => 'required|numeric',
      'release_loanInterest' => 'required|numeric',
      'waive_off' => 'nullable|numeric',
  ]);

  try {
      // Start a database transaction
      DB::beginTransaction();

      $loanExists = LoanRelease::where('loan_number', $validated['release_loanNumber'])->exists();
        if ($loanExists) {
            throw new \Exception('This loan number has already been released.');
        }




      // Retrieve customer ID based on name
      $customerId = Customer::where('customer_id', $validated['release_customerName'])->value('id');
      if (!$customerId) {
          throw new \Exception('Customer not found');
      }




      // Create a new loan release record
      $loanRelease = LoanRelease::create([
          'customer_id' => $customerId,
          'loan_number' => $validated['release_loanNumber'],
          'amount' => $validated['release_loanAmount'],
          'interest' => $validated['release_loanInterest'],
          'waive_off' => $validated['waive_off'],
          'released_by' => session('user_data')->id,
          'location' => isset(session('user_data')->location)?session('user_data')->location:"0",
          'release_date' => now(),
      ]);

      $updated = Loan::where('loan_number', $validated['release_loanNumber'])
        ->update(['status' => 'Released']);

      if (!$updated) {
          throw new \Exception('Failed to update the loan status.');
      }

      // Commit the transaction
      DB::commit();

      // Return success response with the loan ID
      return response()->json(['success' => true, 'loan_id' => $validated['release_loanNumber']]);

  } catch (\Exception $e) {
      // Rollback the transaction in case of any errors
      DB::rollBack();

      // Log the error for debugging
      //\Log::error('Loan release failed: ' . $e->getMessage());

      // Return error response
      return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
  }


  }

  public function releaseLetter($loan_id){


    try {
      // Fetch the loan data based on the loan_id

      $location = session('user_data')->location;
      $branch_detail = Branch::where('id',$location)->first();
      $loan = Loan::where('loan_number', $loan_id)->first();

      // Check if loan exists
      if (!$loan) {
          return response()->json(['status' => 'error', 'message' => 'Loan not found'], 404);
      }

      // Fetch customer data associated with the loan
      $customer = Customer::where('id', $loan->customer_id)->first();

      // Check if customer exists
      if (!$customer) {
          return response()->json(['status' => 'error', 'message' => 'Customer not found'], 404);
      }

      // Return the data as a JSON response
      return view('content.loan.release_letter',compact('customer','branch_detail','loan'));

  } catch (Exception $e) {
      // Catch any exception and return a generic error response
      return response()->json([
          'status' => 'error',
          'message' => 'An error occurred while fetching the data.',
          'error' => $e->getMessage(),
      ], 500);
  }




  }



  public function revokeLoan(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'revoke_loan_number' => 'required|exists:loan_releases,loan_number',
            'revoke_reason' => 'required|string',
            'remarks' => 'nullable|string',
            'revoke_customer_id' => 'required|exists:customers,customer_id',
        ]);

        DB::beginTransaction();

        try {
            // Update the loan_release table with revoke details
            $loanRelease = LoanRelease::where('loan_number', $validated['revoke_loan_number'])->first();
            $loanRelease->revoke_reason = $validated['revoke_reason'];
            $loanRelease->revoke_remarks = $validated['remarks'];
            $loanRelease->revoke_by = session('user_data')->id;
            $loanRelease->deleted_at = now();

            $loanRelease->save();

            // Change loan status in loan table
            $loan = Loan::where('loan_number', $validated['revoke_loan_number'])->first();
            $loan->status = 'Dispatch'; // Assuming 'dispatched' is the status for revoked loans
            $loan->save();

            // Commit the transaction
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Loan revoked successfully']);
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Failed to revoke loan: ' . $e->getMessage()]);
        }
    }


    public function loanTrends(Request $request){

      return view('content.analytics.loan_trending');

    }



public function getLoanChartData()
{
    $currentYear = now()->year;

    // Weekly Loan Trends
    $weeklyData = DB::table('loans')
        ->selectRaw('WEEK(created_at) as week, SUM(total_loan_amount) as total_loan_amount, SUM(total_interest_amount) as total_interest_amount')
        ->whereYear('approved_date', $currentYear)
        ->groupBy('week')
        ->orderBy('week')
        ->get();

    // Monthly Loan Trends
    $monthlyData = DB::table('loans')
        ->selectRaw('MONTH(created_at) as month, SUM(total_loan_amount) as total_loan_amount, SUM(total_interest_amount) as total_interest_amount')
        ->whereYear('approved_date', $currentYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Yearly Loan Trends
    $yearlyData = DB::table('loans')
        ->selectRaw('YEAR(created_at) as year, SUM(total_loan_amount) as total_loan_amount, SUM(total_interest_amount) as total_interest_amount')
        ->groupBy('year')
        ->orderBy('year')
        ->get();

    return response()->json([
        'weekly' => $weeklyData,
        'monthly' => $monthlyData,
        'yearly' => $yearlyData,
    ]);
}




public function getLoanWaveData()
{
  $data = DB::table('loans')
  ->selectRaw('DATE(created_at) as date, SUM(total_loan_amount) as total_amount')
  ->groupBy(DB::raw('DATE(created_at)'))
  ->orderBy('id')
  ->get();

  if ($data->isEmpty()) {
    return response()->json(['message' => 'No data available'], 200);
}

    return response()->json($data);
}


}
