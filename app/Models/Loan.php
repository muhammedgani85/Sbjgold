<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
      'loan_number', 'customer_id', 'location_id', 'loan_type_id', 'loan_amount', 'jewel_grams', 'jewel_net_grams', 'additional_cost', 'total_loan_amount', 'total_interest_amount', 'per_month_payable_amount', 'total_include_int_amount', 'interest_type_id', 'document_charge', 'customer_photo', 'customer_other', 'interest_per', 'interest_month', 'pergram_amount'
  ];

  public function customer()
  {
      return $this->belongsTo(Customer::class);
  }

  public function location()
  {
      return $this->belongsTo(Branch::class);
  }

  public function loanType()
  {
      return $this->belongsTo(LoanType::class);
  }


}
