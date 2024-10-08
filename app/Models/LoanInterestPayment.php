<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanInterestPayment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
      'loan_id',
      'loan_interest_id',
      'payment_amount',
      'payment_date',
      'payment_method',
  ];

  // Relationship to the Loan model
  public function loan()
  {
      return $this->belongsTo(Loan::class);
  }

  // Relationship to the LoanInterest model
  public function loanInterest()
  {
      return $this->belongsTo(LoanInterest::class);
  }
}
}
