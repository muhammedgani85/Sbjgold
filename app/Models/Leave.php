<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['employee_id', 'leave_type', 'start_date', 'end_date', 'status', 'reason', 'remarks', 'location'];

    public function scopeOverlapping($query, $employee_id, $start_date, $end_date)
    {
        return $query->where('employee_id', $employee_id)
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date])
                    ->orWhere(function ($query) use ($start_date, $end_date) {
                        $query->where('start_date', '<=', $start_date)
                            ->where('end_date', '>=', $end_date);
                    });
            });
    }


    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // If you have a 'LeaveReason' relationship, you can define it similarly
    public function leaveReason()
    {
        return $this->belongsTo(LeaveReason::class, 'reason');
    }
}
