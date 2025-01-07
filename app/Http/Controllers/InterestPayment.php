<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\InterestPaymentModel;
use DB;

class InterestPayment extends Controller
{

  public function index($loan_number){

    try{

    if(isset($loan_number)){
    $interst_list = InterestPaymentModel::where('loan_id',$loan_number)->get();
    } else{
      $interst_list = '';
    }



    return view('content.loan.custermer_interest_list',compact('interst_list'));

    }catch(Exception $e){

      return $e->getMessage();

    }

  }



  public function interest_invoice($loan_number,Request $request){


    //dd($month = $request->query('month'));
    try{

    if(isset($loan_number)){

   /*  $interst_list = InterestPaymentModel::where('loan_id',$loan_number)
    ->join('customers', 'interest_payments.loan_id', '=', 'customers.loan_id')
    ->get(); */

    $interst_list = DB::table('loan_interest_payments')
    ->join('loans', 'loan_interest_payments.loan_id', '=', 'loans.loan_number') // Correct table and column names
    ->join('customers', 'loans.customer_id', '=', 'customers.id') // Match your actual column names
    ->select(
        'loan_interest_payments.*',
        'loans.loan_number',
        'loans.created_at',
        'loans.total_loan_amount',
        'customers.first_name',
        'customers.last_name',
        'customers.customer_id',
        'customers.phone_number as customer_contact',
        'customers.communication_address as communication_address',
        'customers.customer_photo as photo'
    )
    ->where('loan_interest_payments.loan_id', $loan_number) // Ensure $loan_number has the correct format
    ->first();




    } else{
      $interst_list = '';
    }



    return view('content.loan.interest_invoice',compact('interst_list'));

    }catch(Exception $e){

      return $e->getMessage();

    }

  }







}
