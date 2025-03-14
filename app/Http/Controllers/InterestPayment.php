<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;
use App\Models\InterestPaymentModel;
use DB;

class InterestPayment extends Controller
{

  public function index($loan_number){

  //  dd($loan_number);
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
    ->join('loans as l', 'loan_interest_payments.loan_id', '=', 'l.loan_number') // Use alias 'l'
    ->join('customers', 'l.customer_id', '=', 'customers.id') // Keep this as it is
    ->join('loan_interests as li', 'li.id', '=', 'l.interest_type_id') // Use alias 'li'
    ->select(
        'loan_interest_payments.*',
        'l.loan_number',
        'l.jewel_grams',
        'l.jewel_net_grams',
        'l.created_at',
        'l.interest_month',
        'l.total_loan_amount',
        'customers.first_name',
        'customers.last_name',
        'customers.customer_id',
        'customers.phone_number as customer_contact',
        'customers.communication_address as communication_address',
        'customers.customer_photo as photo',
        'li.type'
    )
    ->where('loan_interest_payments.loan_id', $loan_number) // Ensure $loan_number has the correct format
    ->first();


    //  dd($interst_list);


    $branch_details = Branch::where('status','Active')->where('id',session('user_data')->location)->first();




    } else{
      $interst_list = '';
    }



    return view('content.loan.interest_invoice',compact('interst_list','branch_details'));

    }catch(Exception $e){

      return $e->getMessage();

    }

  }







}
