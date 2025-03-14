<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Expense;
use App\Models\PublicHoliday;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\EmployeeSalary;
use App\Mail\FollowUpNotificationMail;
use Illuminate\Support\Facades\Mail;
use DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $location = session('user_data')->location;

       $role = session('user_data')->role;
       $is_check = $this->check_role($role);




      if($is_check){
        $employees = User::orderBy('id', 'DESC')->get();

      } else {
        $employees = User::orderBy('id', 'DESC')->where('location', $location)->get();


      }



       // $employees = User::where('location',$location)->get();



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


    $salaryMonth = date('Y-m-01'); // Example: 2024-10-01
    $existingSalary = EmployeeSalary::where('employee_id', $request->employee_id)
                ->whereYear('salary_month', date('Y'))
                ->whereMonth('salary_month', date('m'))
                ->first();

    if ($existingSalary) {

    return redirect()->route('attendance.index')->with('error', 'Salary has already been paid for this employee in the current month.');

    }

    // If no record exists, proceed to create new records
        Expense::create([
        'amount' => str_replace(',', '', $request->amount),
        'description' => $request->description,
        'added_by' => $request->added_by,
        'date' => $request->date,
        'expense_type_id' => 6,
        'location' => $request->location,
        // Any other fields you need to fill
        ]);

        EmployeeSalary::create([
        'salary_month' => $salaryMonth,  // Store full date in 'YYYY-MM-DD' format
        'description' => $request->description,
        'added_by' => $request->added_by,
        'amount' => str_replace(',', '', $request->amount),
        'location' => $request->location,
        'employee_id' => $request->employee_id,
        // Any other fields you need to fill
        ]);

        return redirect()->route('attendance.index')->with('success', 'Salary and expense records created successfully.');

    }catch(Expense $e){


    }
    }


// Email Notification
public function sendFollowUpEmail()
{
    $data = [
        'name' => 'John Doe',
        'follow_date' => '2024-11-10',
        'reason' => 'Monthly Review',
        'comments' => 'Please review the customer profile before the follow-up.',
    ];

    // Check if $data has all required values
    if (empty($data['name']) || empty($data['follow_date']) || empty($data['reason']) || empty($data['comments'])) {
        return response()->json(['error' => 'One or more required values in $data are missing.'], 400);
    }

    Mail::raw('This is a test email', function($message) {
      $message->to('muhammedgn@gmail.com')->subject('Test Email');
  });

    if (Mail::failures()) {
      return response()->json(['message' => 'Failed to send email'], 500);
  }

    return response()->json(['message' => 'Email sent successfully']);
}


public static function check_role($role_id)
{
    // Ensure $role_id is an array
    if (!is_array($role_id)) {
        $role_id = explode(',', $role_id); // Convert comma-separated string to array
    }

    // Cast all values to strings (to match database if `master_id` is stored as strings)
    $role_id = array_map('strval', $role_id);

    $roleExists = DB::table('master_access')
        ->where('master_id', $role_id) // Ensure data type alignment
        ->exists();

    return $roleExists; // Return true if exists, false otherwise
}


}
