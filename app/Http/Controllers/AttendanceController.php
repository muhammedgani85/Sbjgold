<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Expense;
use App\Models\PublicHoliday;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $location = session('user_data')->location;
        $employees = User::where('location',$location)->get();
        $publicHolidays = PublicHoliday::whereYear('date', Carbon::now()->year)->get();
        $monthDays = Carbon::now()->daysInMonth;

        // Get attendance for the current month
        $attendance = Attendance::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->get()
            ->groupBy('employee_id');


  // Calculate for current day
  $currentDay = Carbon::now()->toDateString();
  $presentDayCount = Attendance::where('date', $currentDay)
      ->where('present', true)
      ->count();

  // Calculate for current week (Monday to Sunday)
  $currentWeekStart = Carbon::now()->startOfWeek();
  $currentWeekEnd = Carbon::now()->endOfWeek();
  $presentWeekCount = Attendance::whereBetween('date', [$currentWeekStart, $currentWeekEnd])
      ->where('present', true)
      ->count();

  // Calculate for current month
  $currentMonthStart = Carbon::now()->startOfMonth();
  $currentMonthEnd = Carbon::now()->endOfMonth();
  $presentMonthCount = Attendance::whereBetween('date', [$currentMonthStart, $currentMonthEnd])
      ->where('present', true)
      ->count();




        return view('content.attendance.index', compact('employees', 'publicHolidays', 'monthDays', 'attendance','presentDayCount', 'presentWeekCount','presentMonthCount'));
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
        $attendanceData = $request->input('attendance');

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        Attendance::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->delete();

        foreach ($attendanceData as $employeeId => $days) {

            foreach ($days as $date => $present) {
                // Determine if checkbox is checked
                $isChecked = $present === 'on';

                // Find attendance record for the employee and date
                $attendance = Attendance::where('employee_id', $employeeId)
                    ->where('date', $date)
                    ->first();



                if ($isChecked && !$attendance) {
                    // Create new attendance record if it doesn't exist and checkbox is checked
                    Attendance::create([
                        'employee_id' => $employeeId,
                        'date' => $date,
                        'present' => true,
                    ]);
                } elseif (!$isChecked && $attendance) {
                    // Delete attendance record if it exists and checkbox is unchecked
                    $attendance->delete();
                } elseif ($isChecked && $attendance && !$attendance->present) {
                    // Update attendance record if it exists but not present and checkbox is checked
                    $attendance->update(['present' => true]);
                }
            }
        }

        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully');
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

    public function paidsalary(Request $request){

    try{

      $data = $request->all();
      Expense::create([
        'amount' =>  str_replace( ',', '', $request->amount),  // Ensure amount is in the correct numeric format
        'description' => $request->description,
        'added_by' => $request->added_by,  // Assuming added_by is an integer referencing a user ID
        'date' => $request->date,   // Ensure date is in YYYY-MM-DD format
        'expense_type_id' => 13,  // Assuming expense_type_id is an integer referencing an expense type ID
        'location' => $request->location,  // Assuming location is an integer referencing a location ID
        // Any other fields you need to fill
    ]);
    }catch(Expense $e){

    }



    }
}
