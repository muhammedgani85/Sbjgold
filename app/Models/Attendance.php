<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['employee_id', 'date', 'present'];
    protected $dates = ['deleted_at'];
    protected $table = 'attendances';
    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
