<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roles_list = Roles::with(['addedByUser','updatedByUser'])->get();
        return view('content.roles.index',compact('roles_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('content.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
        'role_name' => 'required|string|max:255|unique:branches,branch_name',

    ], [
        'role_name.unique' => 'The Role name already exists.',

    ]);

      Roles::create($request->all());
      return redirect()->route('roles.index')->with('success', 'Roles created successfully.');
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
    public function edit($id)
    {
      $roles = Roles::find($id); // Or Roles::where('id', $id)->first();

      if (!$roles) {
          abort(404, 'Role not found');
      }
      return view('content.roles.edit', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


      $request->validate([
        'role_name' => 'required|string|max:255|unique:branches,branch_name',

    ], [
        'role_name.unique' => 'The Role name already exists.',

    ]);
      $roles = Roles::findOrFail($id);
      $roles->update($request->only('role_name', 'status','updated_by'));

      return redirect()->route('roles.index')->with('success', 'Roles updated successfully.');
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

        $roles = Roles::find($id);

        if ($roles) {
            $roles->status = 'InActive';
           // $user->deleted_at = now();
            $roles->save();

            return response()->json(['success' => true, 'message' => 'Roles status updated to Inactive.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Role not found.'], 404);
        }

      }catch(Exception $e){

      }

    }



}
