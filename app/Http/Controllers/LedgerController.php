<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Fund;
use App\Models\Loan;
use App\Models\LoanInterest;
use App\Models\OtherBankLoan;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      // Retrieve filters
      $startDate = $request->input('start_date', now()->startOfMonth());
      $endDate = $request->input('end_date', now()->endOfMonth());
      $branchId = $request->input('branch_id');
      $location = session('user_data')->location;
      // Opening balance
      $addBalance = Fund::where('location', $location)->where('type','Add')

          ->value('amount') ?? 0;

          $withBalance = Fund::where('location', $location)->where('type','withdraw')

          ->value('amount') ?? 0;

          $openingBalance = $addBalance - $withBalance;
      // Loans
      $totalLoans = Loan::whereBetween('created_at', [$startDate, $endDate])->where('status','Dispatch')
                    ->where('location_id', $location)
                    ->sum('total_loan_amount');

      // Other loans
      $totalOtherLoans = OtherBankLoan::whereBetween('created_at', [$startDate, $endDate])->where('location', $location)
          ->sum('loan_amount');

      // Expenses
      $totalExpenses = Expense::whereBetween('created_at', [$startDate, $endDate])->where('location', $location)
          ->sum('amount');

      $totalLoansInt = LoanInterest::whereBetween('created_at', [$startDate, $endDate])
      ->sum('interest_amount');

      // Net balance calculation
     // $netBalance = $openingBalance + $totalLoans + $totalOtherLoans - $totalExpenses;

      $netBalance = ($openingBalance + $totalLoansInt)- ($totalLoans + $totalExpenses);

      // Return data to view
      return view('content.loan.ledger_report', compact(
          'openingBalance',
          'totalLoans',
          'totalOtherLoans',
          'totalExpenses',
          'netBalance',
          'startDate',
          'endDate',
          'branchId',
          'totalLoansInt'
      ));

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
