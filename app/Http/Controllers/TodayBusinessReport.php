<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Expense;
use App\Models\Loan;
use App\Models\LoanInterestPayment;
use App\Models\LoanRelease;
use App\Models\OtherBankLoan;
use Illuminate\Http\Request;

class TodayBusinessReport extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
    {
      $location = session('user_data')->location;

      $date = $request->input('date', today()->toDateString());
      $locationId = $request->input('location', $location);

      // Query for new loans
      $newLoans = Loan::whereDate('created_at', $date)
          ->when($locationId, function ($query) use ($locationId) {
              return $query->where('location_id', $locationId);
          })
          ->selectRaw('COUNT(*) as total_loans, SUM(jewel_net_grams) as total_grams, SUM(total_loan_amount) as total_amount')
          ->first();

      // Query for released loans
      $releasedLoans = Loan::whereDate('created_at', $date)
          ->where('status', 'Dispatch')
          ->when($locationId, function ($query) use ($locationId) {
              return $query->where('location_id', $locationId);
          })
          ->selectRaw('COUNT(*) as total_released, SUM(jewel_net_grams) as total_grams, SUM(total_loan_amount) as total_amount')
          ->first();

      // Query for total loans up to today
      $totalLoans = Loan::whereDate('created_at', '=', $date)
          ->when($locationId, function ($query) use ($locationId) {
              return $query->where('location_id', $locationId);
          })
          ->selectRaw('
        COUNT(*) as total_loans,
        SUM(total_loan_amount) as total_amount,
        SUM(jewel_net_grams) as upto_total_grams,
        SUM(document_charge) as total_document_charges,
        SUM(CASE WHEN DATE(created_at) = ? THEN total_loan_amount ELSE 0 END) as today_total_amount,
        COUNT(CASE WHEN DATE(created_at) = ? THEN 1 ELSE NULL END) as today_total_loans', [$date, $date])
          ->first();

      // Query for today's expenses
      $todayExpenses = Expense::whereDate('date', $date)
          ->when($locationId, function ($query) use ($locationId) {
              return $query->where('location', $locationId);
          })
          ->sum('amount');

      // Query for interest received
      $interestReceived = LoanInterestPayment::whereDate('created_at', $date)
          ->when($locationId, function ($query) use ($locationId) {
             // return $query->where('location', $locationId);
          })
          ->sum('interest_amount');

      // Query for other bank loans
      $otherBankLoans = OtherBankLoan::join('loans', 'loans.loan_number', '=', 'other_bank_loans.customer_loan_no')
          ->when($locationId, function ($query) use ($locationId) {
              return $query->where('loans.location_id', $locationId);
          })
          ->selectRaw(
              'SUM(loans.jewel_net_grams) as total_grams,
               SUM(other_bank_loans.loan_amount) as total_amount,
               SUM(other_bank_loans.document_charges) as other_bank_document_charges,
               COUNT(other_bank_loans.id) as total_loans'
          )
          ->first();



      // Loan Released

      $loanRelease = LoanRelease::join('loans', 'loans.loan_number', '=', 'loan_releases.loan_number')
          ->when($locationId, function ($query) use ($locationId) {
              return $query->where('loans.location_id', $locationId);
          })
          ->selectRaw(
              'SUM(loans.jewel_net_grams) as total_grams,
               SUM(loan_releases.amount) as total_amount,
               SUM(loan_releases.interest) as total_interest,
               COUNT(loan_releases.id) as total_loans'
          )
          ->first();

      // Combine all data into the report
      $dailyReport = [
          'new_loans' => [
              'total' => $newLoans->total_loans,
              'grams' => $newLoans->total_grams,
              'amount' => $newLoans->total_amount,
          ],
          'released_loans' => [
              'total' => $releasedLoans->total_released,
              'grams' => $releasedLoans->total_grams,
              'amount' => $releasedLoans->total_amount,
          ],
          'total_loans_upto_today' => [
              'total' => $totalLoans->total_loans,
              'amount' => $totalLoans->total_amount,
              'upto_total_grams' => $totalLoans->upto_total_grams,
              'total_document_charges' => $totalLoans->total_document_charges,
          ],
          'other_bank_loans' => [
              'total' => $otherBankLoans->total_loans ?? 0,
              'grams' => $otherBankLoans->total_grams ?? 0,
              'amount' => $otherBankLoans->total_amount ?? 0,
              'other_bank_document_charges' => $otherBankLoans->other_bank_document_charges ?? 0,
          ],
          'loan_release' => [
            'amount' => $loanRelease->total_amount + $loanRelease->total_interest ?? 0,
            'total_grams' => $loanRelease->total_grams ?? 0,

           ],
          'today_expenses' => $todayExpenses,
          'interest_received' => $interestReceived,
      ];



    $locations = Branch::all();


      return view('content.today_business.index',compact('dailyReport','locations'));
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
