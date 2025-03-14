<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelecallerFollow extends Model
{
    use HasFactory;
    protected $table ='telecaller_follow';
    protected $fillable = ['customer_id', 'reason', 'comments', 'follow_date','loan_number'];
}
