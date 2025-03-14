<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\User;
use App\Models\Leave;

use Illuminate\Http\Request;

class LeaveReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $location = session('user_data')->location;
      $role = session('user_data')->role;

      // Set default date range to current month if no input
      $fromDate = $request->input('from_date', now()->startOfMonth()->toDateString());
      $toDate = $request->input('to_date', now()->endOfMonth()->toDateString());

      // Get list of locations and employees
      $locations = Branch::all();
      $employees = User::all();

      // Query initialization with relationships
      $query = Leave::with(['employee', 'leaveType', 'leaveReason', 'approvedBy','branch'])
              ->whereBetween('start_date', [$fromDate, $toDate]);

      // Location-based filter (only show user's location by default)
      if (in_array($role, [1, 9, 10])) {
          // Allow location filter for roles with access
          if ($request->filled('location') && $request->input('location') !== 'all') {
              $query->where('location', $request->input('location'));
          }
      } else {
          // Restrict to user's location only
          $query->where('location', $location);
      }

      // Apply employee and leave type filters if provided
      if ($request->filled('employee_id')) {
          $query->where('employee_id', $request->input('employee_id'));
      }
      if ($request->filled('leave_type')) {
          $query->where('leave_type', $request->input('leave_type'));
      }

      // Fetch filtered results
      $leaves = $query->get();

      // Export functionality (optional)
     /*  if ($request->input('export') === 'true') {
          return Excel::download(new LeaveReportExport($leaves), 'leave_report.xlsx');
      } */

      #dd($leaves);

      // Pass data to the view
      return view('content.leaves.report.index', compact(
          'leaves', 'locations', 'employees', 'fromDate', 'toDate', 'role'
      ));
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
