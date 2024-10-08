<?php

namespace App\Http\Controllers;

use App\Models\LoanInterest;
use App\Models\InterestPaymentModel;
use Illuminate\Http\Request;

class LoanInterestController extends Controller
{
  public function index()
  {
    $loanInterests = LoanInterest::with('loanType')->get();

      return view('content.loan_interests.index', compact('loanInterests'));
  }

  public function create()
  {
      return view('loan_interests.create');
  }

  public function store(Request $request)
  {

       // dd($request->all());
        $request->validate([
        'loan_number' => 'required',
        'payment_month' => 'required',
        'payment_amount' => 'required|numeric',
        'payment_method' => 'required',
        ]);


        $interestExists = InterestPaymentModel::where('loan_id', $request->loan_number)
        ->where('month', $request->payment_month)
        ->exists();

        if ($interestExists) {
        return response()->json(['success' =>  'Interest for this month has already been paid.']);
        }

        // If the month has not been paid, create a new interest record
        InterestPaymentModel::create([
        'loan_id' => $request->loan_number, // Assuming interest table links to the loan table by loan_id
        'month' => $request->payment_month, // Month number
        'interest_amount' => $request->payment_amount,
        'payment_method' => $request->payment_method,
        'user_id' => session('user_data')->id, // Get logged-in user ID
        ]);

        return response()->json(['success' => 'Interest payment recorded successfully.']);
  }



}
