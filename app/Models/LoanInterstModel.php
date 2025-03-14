<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanInterstModel extends Model
{
    use HasFactory;
    protected $table ='loan_interests';
    protected $fillable = ['type', 'interest_rate', 'interest_percentage', 'per_gram_amount', 'months', 'status', 'document_charge', 'loan_type_id'];
}
