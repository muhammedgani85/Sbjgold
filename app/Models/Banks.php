<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banks extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='banks';
    protected $fillable =['bank_name', 'location', 'status'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'location', 'id');
    }
}
