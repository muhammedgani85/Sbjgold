<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='funds';
    protected $fillable = ['location', 'amount', 'description', 'added_by', 'type'];


    public function branch()
    {
        return $this->belongsTo(Branch::class, 'location', 'id');
    }
}
