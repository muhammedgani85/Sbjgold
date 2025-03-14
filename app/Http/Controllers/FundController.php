<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Fund;
use DB;
use Exception;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      try{

      $location = Branch::where('status','Active')->get();

      $funds = DB::table('funds')
        ->join('branches', 'funds.location', '=', 'branches.id')  // Joining funds with branches
        ->join('users', 'funds.added_by', '=', 'users.id')  // Joining funds with users (added_by)
        ->select('funds.*', 'branches.branch_name', 'users.first_name as added_by_name')  // Select fields from funds, branches, and users
        ->where('funds.deleted_at',NULL)
        ->get();




      return view('content.funds.index',compact('location','funds'));

      }catch(Exception $e){

      }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'type' => 'required|in:add,withdraw',
        ]);

        DB::beginTransaction();

        try {
            Fund::create($request->all());

            DB::commit();
            return response()->json(['success' => 'Fund entry created successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the exception message for debugging
            \Log::error('Error creating fund entry: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to create fund entry. Please try again.'], 500);
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
       try{
        $fund = Fund::find($id);

        if ($fund) {
            $fund->deleted_at = now();
            // $user->deleted_at = now();
            $fund->save();

            return response()->json(['success' => true, 'message' => 'Funds Deleted.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Fund not found.'], 404);
        }





       }catch(Exception $e){

       }
    }







}
