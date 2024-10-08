<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OccupationModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $date = ['deleted_at'];
    protected $fillable = [
        'occupation', 'status'
    ];
}
