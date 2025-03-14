<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\User;

class CustomerReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get session data for the current user's location and role
        $location = session('user_data')->location;
        $role = session('user_data')->role;

        // Define filter options
        $fromDate = $request->input('from_date', now()->startOfMonth()->toDateString());
        $toDate = $request->input('to_date', now()->endOfMonth()->toDateString());
        $status = $request->input('status');
        $branchId = $request->input('branch_id');

       // dd($request->all());

        // Retrieve all branches for the dropdown
        $branches = Branch::all();

        // Initialize the customer query with default filters
        $query = Customer::with('branch')
                        ->whereBetween('created_at', [$fromDate, $toDate]);

        // Location-based filter
        if (in_array($role, [1, 8, 10])) { // Only specific roles can view all branches
            // Check if branch filter is selected
            if ($request->filled('branch_id') && $branchId !== 'all') {
                // Filter by selected branch
                $query->where('location_id', $branchId);
            }
            // If 'All' is selected, do not apply any branch filter
        } else {
            // Restrict to the user's default location for other roles
            //$query->where('location_id', $location);
        }

        // Apply status filter if provided
        if ($request->filled('status')) {
            $query->where('status', $status);
        }

        // Fetch filtered results
        $customers = $query->get();

        // If no records found, fetch all customers from the user's branch for the current month
        if ($customers->isEmpty()) {
                $fallbackQuery = Customer::with('branch')
                ->where('location_id', $location);

                // Apply status filter if provided
                if ($request->filled('status')) {
                $fallbackQuery->where('status', $status);
                }

                // Optional: Uncomment the below line if you want to restrict by date in the fallback query
                // $fallbackQuery->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);

                $customers = $fallbackQuery->get();
        }



//dd($customers);

// Pass data to the view
return view('content.customermanagement.report.index', compact('customers', 'branches', 'fromDate', 'toDate', 'status', 'branchId','role'));




        // Pass data to the view

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
}
