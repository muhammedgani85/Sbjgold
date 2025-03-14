<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SHLoanRelease extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='sh_loan_releases';
    protected $fillable = ['customer_id', 'loan_number', 'amount', 'interest', 'waive_off', 'released_by', 'release_date','location'];
}
