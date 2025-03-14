<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanAction extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
      'loan_id',
      'customer_id',
      'action_type',
      'send_by',
  ];

  // Relationships
  public function loan()
  {
      return $this->belongsTo(Loan::class);
  }

  public function customer()
  {
      return $this->belongsTo(Customer::class);
  }

  public function sender()
  {
      return $this->belongsTo(User::class, 'send_by');
  }
}
