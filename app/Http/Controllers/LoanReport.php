<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\LoanInterest;
use App\Models\LoanRelease;
use App\Models\LoanType;
use App\Models\OtherBankLoan;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoanReport extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      try {
        $role = session('user_data')->role;
        $location = session('user_data')->location;

        // Fetch distinct loan statuses
        $loan_status = Loan::distinct()->pluck('status');

        // Start building the query
        $query = Loan::with(['loanType', 'location', 'customer'])->orderBy('id', 'DESC');

        // Apply filters based on request inputs
        if ($request->has('location') && $request->location != '') {
            $query->where('location_id', $request->location);
        } else {
            // Default location for non-privileged roles
            $query->where('location_id', $location);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        // Get the filtered loans
        $loans = $query->get();

        // Fetch active branches
        $branch = Branch::where('status', 'Active')->get();

        return view('content.loan.loan_report', compact('loans', 'role', 'branch', 'loan_status'))
            ->with([
                'search_location' => $request->location,
                'search_status' => $request->status,
                'search_from_date' => $request->from_date,
                'search_to_date' => $request->to_date,
            ]);
    } catch (\Exception $e) {
        // Log the error for debugging purposes


        // Optionally, redirect with an error message
        return redirect()->back()->with('error', 'An error occurred while generating the loan report. Please try again later.');
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

  public function sh_loan_report(Request $request){


    try {
      $location = session('user_data')->location;
      $role = session('user_data')->role;

      // Get filter inputs
      $from_date = request('from_date');
      $to_date = request('to_date');
      $branch_id = request('location');
      $status = request('status');

      // Query with filters
      $other_loans = OtherBankLoan::with(['customer', 'bank'])
          ->when($from_date, function ($query) use ($from_date) {
              $query->whereDate('created_at', '>=', $from_date);
          })
          ->when($to_date, function ($query) use ($to_date) {
              $query->whereDate('created_at', '<=', $to_date);
          })
          ->when($branch_id, function ($query) use ($branch_id) {
              $query->where('bank_id', $branch_id);
          })
        /*  ->when($status, function ($query) use ($status) {
              $query->where('status', $status);
          }) */
          ->orderBy('id', 'DESC')
          ->get();

      $branch = Branch::where('status', 'Active')->get();
      $banks = Banks::where('status', 'Active')->get();
      $loan_status = OtherBankLoan::distinct()->pluck('status');

      return view('content.other_bank_loan.sh_loan_report', compact('other_loans', 'branch', 'role','banks','loan_status'));

  } catch (Exception $e) {
      // Handle exception
      return back()->with('error', 'Something went wrong!');
  }



  }




}
