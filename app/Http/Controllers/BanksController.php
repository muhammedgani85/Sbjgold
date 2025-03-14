<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.p
     */
    public function index()
    {
      try{
      $banks = Banks::with('branch')->get();

      return view('content.banks.index',compact('banks'));
      }catch(Exception $e){
        return redirect()->back()->with('error',$e->getMessage());

      }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $bank_list = Branch::where('status','Active')->get();
      return view('content.banks.create',compact('bank_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
  //  \Log::info('Store method hit', $request->all()); // Log input data

 // dd($request->all());
    $validated = $request->validate([
        'bank_name' => 'required|string|max:255',
        'location' => 'required|integer',
    ]);

  //  \Log::info('Validation passed', $validated); // Log validated data

    $bank = new \App\Models\Banks();
    $bank->bank_name = $validated['bank_name'];
    $bank->location = $validated['location'];
    $bank->save();

  //  \Log::info('Bank saved', $bank->toArray()); // Log saved bank

    return response()->json(['success' => true, 'message' => 'Bank created successfully!', 'data' => '']);
}

public function banks_store(Request $request){

      $validated = $request->validate([
      'bank_name' => 'required|string|max:255',
      'location' => 'required|integer',
      ]);

      //  \Log::info('Validation passed', $validated); // Log validated data

      $bank = new Banks();
      $bank->bank_name = $validated['bank_name'];
      $bank->location = $validated['location'];
      $bank->save();

      //  \Log::info('Bank saved', $bank->toArray()); // Log saved bank

      return response()->json(['success' => true, 'message' => 'Bank created successfully!', 'data' => '']);

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
    public function edit(Banks $bank)
    {
       $bank_list = Branch::where('status','Active')->get();
        return view('content.banks.edit',compact('bank','bank_list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
          'bank_name' => 'required|string|max:255',
          'location' => 'required|string',

        ]);

       // dd($request->all());
        $bank = Banks::findOrFail($id);
        $bank->update($request->all());
        //return redirect()->route('sandhas.index')->with('success', 'Sandha updated successfully.');
        return response()->json(['success' => true, 'message' => 'Bank status updated to Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
