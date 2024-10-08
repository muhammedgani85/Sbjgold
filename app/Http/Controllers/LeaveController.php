<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\Roles;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LoanHelper;
use App\Models\Customer;
use App\Models\Leave;
use App\Models\LeaveReason;
use App\Models\LeaveType;
use App\Models\OccupationModel;
use App\Models\PublicHoliday;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $location = session('user_data')->location;
        $currentMonthStart = Carbon::now()->startOfMonth();
        $nextMonth5th = Carbon::now()->addMonth()->startOfMonth()->addDays(4);
        $today = Carbon::today();

        $Tleaves = Leave::with('leaveType', 'employee', 'leaveReason')->where('location', $location)->orderBy('created_at', 'DESC')->where('status','Approved')->get();
        $leaves = Leave::with('leaveType', 'employee', 'leaveReason')->where('location', $location)
            ->whereDate('start_date', '>=', $currentMonthStart)
            ->whereDate('start_date', '<=', $nextMonth5th)
            ->orderBy('created_at', 'DESC')->get();


        $totalLeave = $Tleaves->count();
        $countLast7Days = $Tleaves->filter(function ($leave) {
            return Carbon::parse($leave->created_at)->gte(Carbon::now()->subDays(7));
        })->count();

        // Count based on weeks (current week)
        $countCurrentWeek = $Tleaves->filter(function ($leave) use ($today) {
            return Carbon::parse($leave->start_date)->isCurrentWeek();
        })->count();

        // Count based on months (current month)
        $countCurrentMonth = $Tleaves->filter(function ($leave) {
            return Carbon::parse($leave->start_date)->isCurrentMonth();
        })->count();



        // Count leaves created today


        // Assuming $Tleaves is already populated with leaves data
        $countTodayLeaves = $Tleaves->filter(function ($leave) use ($today) {
            return Carbon::parse($leave->start_date)->toDateString() === $today->toDateString();
        })->count();

        return view('content.leaves.dashboard', compact('leaves', 'countLast7Days', 'countCurrentWeek', 'countCurrentMonth', 'countTodayLeaves', 'totalLeave'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data = session('user_data');
        $employee_data = User::where('id', $data->id)->first();
        $cus_id = $employee_data->emp_id;
        $emp_id = $employee_data->id;
        $location = $employee_data->location;
        $leaveTypes = LeaveType::all();
        $leavereason = LeaveReason::all();
        $myleaves = Leave::with('leaveType', 'employee', 'leaveReason')->where('employee_id', $emp_id)->orderBy('created_at', 'DESC')->get();
        $holidays = PublicHoliday::currentYear()->orderBy('date', 'DESC')->get();
        $currentDate = Carbon::today();
        foreach ($holidays as $holiday) {
            $holiday->date = Carbon::parse($holiday->date); // Ensure 'date' is a Carbon instance
            $holiday->isPast = $holiday->date->lt($currentDate);
        }
        // dd($myleaves);

        $leave_list = Leave::with('employee', 'leaveType')->where('employee_id', $data->id)->get();
        //dd($leave_list);

        return view('content.leaves.newleave', compact('emp_id', 'leaveTypes', 'leavereason', 'cus_id', 'myleaves', 'holidays', 'location'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'employee_id' => 'required|exists:users,id',
                'leave_type' => 'required|exists:leave_types,id',
                'reason' => 'required|exists:leave_reasons,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $overlappingLeave = Leave::overlapping(
                $request->employee_id,
                $request->start_date,
                $request->end_date
            )->exists();

            if ($overlappingLeave) {

                return response()->json(['errors' => ['date_overlap' => 'Leave dates overlap with an existing leave.']], 422);
                //return response()->json(['errors' => 'Leave Applied successfully']);
            }


            Leave::create($request->all());

            return response()->json(['success' => 'Leave Applied successfully']);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
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


    public function approve(Request $request, $id)
    {
        try {
            $leave = Leave::find($id);

            if (!$leave) {
                return response()->json(['error' => 'Leave not found.'], 404);
            }

            // Update status to 'Withdraw'
            $leave->status = 'Approved';
            $leave->approved_by = session('user_data')->id;
            $leave->save();

            return response()->json(['message' => 'Leave approvded successfully.']);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    public function cancel(Request $request, $id)
    {
        try {
            $leave = Leave::find($id);

            if (!$leave) {
                return response()->json(['error' => 'Leave not found.'], 404);
            }

            // Update status to 'Withdraw'
            $leave->status = 'Cancelled';
            $leave->approved_by = session('user_data')->id;
            $leave->save();

            return response()->json(['message' => 'Leave Cancelled successfully.']);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    public function withdraw(Request $request, $id)
    {
        try {
            $leave = Leave::find($id);

            if (!$leave) {
                return response()->json(['error' => 'Leave not found.'], 404);
            }

            // Update status to 'Withdraw'
            $leave->status = 'Withdrawn';
            $leave->approved_by = session('user_data')->id;
            $leave->save();

            return response()->json(['message' => 'Leave withdrawn successfully.']);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    public function remove($id)
    {



        try {
            $leave = Leave::findOrFail($id);
            $leave->delete();
            // Delete each leave record


            return response()->json(['message' => 'Leaves removed successfully.']);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }
}
