<?php

namespace App\Http\Controllers;
use App\Models\LoanInterestPayment;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;

use Exception;
use Illuminate\Http\Request;

class LoanInterestPaymentController extends Controller
{

  public function saveInterest(Request $request){
    try{

      // Recording a new loan interest payment
      DB::transaction(function () use ($loanId) {
        // Create the LoanInterestPayment record
        $loanInterestPayment = new LoanInterestPayment([
            'payment_amount' => 500.00,
            'payment_date' => now(),
            'payment_method' => 'cash',
        ]);

        // Find the loan by ID
        $loan = Loan::find($loanId);

        // Ensure the loan exists
        if ($loan) {
            // Get the related LoanInterest
            $loanInterest = $loan->loanInterest;

            // Ensure the loanInterest exists
            if ($loanInterest) {
                // Save the payment record
                $loanInterest->payments()->save($loanInterestPayment);
            } else {
                throw new \Exception("Loan interest record not found.");
            }
        } else {
            throw new \Exception("Loan record not found.");
        }
    });





    }catch(Exception $e){

    }
  }



}
