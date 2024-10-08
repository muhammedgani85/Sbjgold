<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use App\Models\Roles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LoanHelper;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();




        return view('content.usersmanagement.dashboard', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Roles::where('status', 'Active')->get();
        $branchs = Branch::where('status', 'Active')->get();
        $employee = [];
        return view('content.usersmanagement.forms-basic-inputs', compact('roles', 'branchs', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {



        try {



            $validator = Validator::make($request->all(), [
                'initial' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'father_name' => 'required',
                'phone_number' => 'required|numeric',
                'emergency_number' => 'required|numeric',
                'city' => 'required',
                'address' => 'required',
                'aadhar_number' => 'required|numeric',
                /*  'driving_license_number' => 'required', */
                /* 'pan' => 'required', */
                'salary' => 'required|numeric',
                /* 'deduction' => 'required|numeric', */
                /*  'others' => 'required|numeric', */
                'role' => 'required',
                'user_name' => 'required',
                'password' => 'required',
                'emp_id' => 'required',
                /* 'document' => 'required|file|mimes:jpg,png,pdf,docx', */
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            if ($request->hasFile('document')) {
                $filePath = $request->file('document')->store('uploads', 'public');
                $validated['file_path'] = $filePath;
                $user->document = $filePath;
            }
            // Create the employee
            $data = $request->all();
            $employee = User::create($data);

            // Return success response
            return response()->json(['success' => 'Employee created successfully!', 'employee' => $employee], 201);
        } catch (Exception $e) {

            dd($e->getMessage());
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
        $employee = User::findOrFail($id);
        $roles = Roles::all(); // Assuming you have a Role model
        $branches = Branch::all(); // Assuming you have a Branch model

        return view('content.usersmanagement.user_edit', compact('employee', 'roles', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'initial' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'phone_number' => 'required|numeric',
            'emergency_number' => 'required|numeric',
            'city' => 'required',
            'address' => 'required',
            'aadhar_number' => 'required|numeric',
            /*  'driving_license_number' => 'required', */
            'pan' => 'required',
            'salary' => 'required|numeric',
            /* 'deduction' => 'required|numeric', */
            /*  'others' => 'required|numeric', */
            'role' => 'required',
            'user_name' => 'required',
            /*  'password' => 'required', */
            /* 'emp_id' => 'required', */
            /* 'document' => 'required|file|mimes:jpg,png,pdf,docx', */
        ]);


        $employee = User::findOrFail($id);
        $employee->update($request->except('password'));
        if ($request->filled('password')) {
            $employee->password = bcrypt($request->password);
            $employee->save();
        }
        $employee->update($request->all());

        return response()->json(['success' => 'Employee information updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return response()->json(['success' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the user']);
        }
    }

    public function softDelete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->status = 'Inactive';
            $user->deleted_at = now();
            $user->save();

            return response()->json(['success' => true, 'message' => 'User status updated to Inactive.']);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }
    }
    public function getLocationCount(Request $request)
    {
        $locationId = $request->input('location_id');

        // Assuming you have a location_code in your locations table
        $location = Branch::find($locationId);
        $count = User::where('location', $locationId)->count();

        return response()->json([
            'success' => true,
            'count' => $count,
            'location_code' => $location->branch_prefix // Assuming 'code' is the column name
        ]);
    }
}
