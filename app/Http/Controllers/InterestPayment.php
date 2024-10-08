<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\InterestPaymentModel;

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
    $interst_list = InterestPaymentModel::where('loan_id',$loan_number)->get();
    } else{
      $interst_list = '';
    }



    return view('content.loan.interest_invoice',compact('interst_list'));

    }catch(Exception $e){

      return $e->getMessage();

    }

  }







}
