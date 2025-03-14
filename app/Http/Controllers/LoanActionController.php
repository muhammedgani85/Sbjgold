<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class LoanActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

  public function ActionCustomer(Request $request){

   // dd($request->all());

   $type = $request->input('action_type');
   $location = session('user_data')->location;

   $org_details = Branch::where('id',$location )->first();

    // Conditional redirection based on type
    switch ($type) {
      case 1:
        $data['loan_number'] = '500,000';
        $data['loan_amount'] = '500,000';
        $data['customer_name'] = '500,000';
        $data['interest_rate'] = '5';
        $data['emi_start_date'] = '2024-01-01';
        return view('content.loan_action.action_one',compact('data','org_details'));

    case 2:
      $data['loan_number'] = '500,000';
        $data['loan_amount'] = '500,000';
        $data['customer_name'] = '500,000';
        $data['interest_rate'] = '5';
        $data['emi_start_date'] = '2024-01-01';
        return view('content.loan_action.second',compact('data','org_details'));
    case 3:
      $data['loan_number'] = '500,000';
        $data['loan_amount'] = '500,000';
        $data['customer_name'] = '500,000';
        $data['interest_rate'] = '5';
        $data['emi_start_date'] = '2024-01-01';
        return view('content.loan_action.three',compact('data','org_details'));

    }


  }
}
