<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelecallerFollow;

class TelecallerFollowController extends Controller
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

      #dd($request->all());

      try{

       /*  $request->validate([
          'customer_id' => 'required|exists:customers,id',
          'reason' => 'required|string',
          'comments' => 'required|string',
          'follow_date' => 'required|date',
      ]); */

      TelecallerFollow::create([
          'customer_id' => $request->input('customer_id'),
          'reason' => $request->input('reason'),
          'comments' => $request->input('comments'),
          'follow_date' => $request->input('follow_date'),
          'loan_number' => $request->input('loan_number')
      ]);

      return redirect()->back()->with('success', 'Follow-up saved successfully.');

      }catch(Exception $e){

      }


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

    public function showFollowUpModal(Request $request)
{
    $customerId = $request->query('customer_id');
    $loanNumber = $request->query('loan_number');

    $previousFollowUps = TelecallerFollow::where('customer_id', $customerId)
                        ->where('loan_number', $loanNumber)
                        ->orderBy('follow_date', 'desc')
                        ->get();

    return response()->json($previousFollowUps);
}



}
