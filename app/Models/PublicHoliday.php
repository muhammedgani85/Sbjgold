<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PublicHoliday extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['date', 'name'];

    protected $dates = ['deleted_at'];

    public function scopeCurrentYear($query)
    {
        $currentYear = Carbon::now()->year;
        return $query->whereYear('date', $currentYear);
    }
}
