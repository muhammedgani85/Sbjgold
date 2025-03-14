<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('content.branch.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('content.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          'branch_name' => 'required|string|max:255|unique:branches,branch_name',
          'branch_prefix' => 'required|string|unique:branches,branch_prefix',
      ], [
          'branch_name.unique' => 'The branch name already exists.',
          'branch_prefix.unique' => 'The branch prefix already exists.',
      ]);

        Branch::create($request->all());
        return redirect()->route('branch.index')->with('success', 'Location created successfully.');
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
    public function edit(Branch $branch)
    {
        return view('content.branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {


        $request->validate([
          'branch_name' => 'required|string|max:255',
          'branch_prefix' => 'required|string',

        ]);

        $branch->update($request->all());
        //return redirect()->route('sandhas.index')->with('success', 'Sandha updated successfully.');
        return response()->json(['success' => true, 'message' => 'Location status updated to Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function softDelete($id)
    {
      try{

        $branch = Branch::find($id);

        if ($branch) {
            $branch->status = 'InActive';
           // $user->deleted_at = now();
            $branch->save();

            return response()->json(['success' => true, 'message' => 'Location status updated to Inactive.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Location not found.'], 404);
        }

      }catch(Exception $e){

      }

    }


}
