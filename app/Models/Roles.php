<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable =['role_name', 'status','added_by','updated_by'];
    public function addedByUser()
    {
    return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedByUser()
    {
    return $this->belongsTo(User::class, 'updated_by');
    }
}
