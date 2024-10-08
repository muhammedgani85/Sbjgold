<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveType extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'default_days'];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
