<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =['branch_name', 'status', 'branch_prefix', 'created_at', 'updated_at', 'deleted_at', 'address', 'mobile_number', 'GST', 'org_name'];
public function users(){
    return $this->hasMany(User::class, 'location');
}
public function leaves()
{
    return $this->hasMany(Leave::class, 'location');
}

public function funds()
    {
        return $this->hasMany(Fund::class, 'location');
    }


}
