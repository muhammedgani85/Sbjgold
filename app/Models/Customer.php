<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $date = ['deleted_at'];
    protected $fillable = ['customer_id', 'initial', 'first_name', 'last_name', 'father_name', 'spouse_name', 'gender', 'dob', 'marital_status', 'phone_number', 'emergency_number', 'email_id', 'city', 'permanent_address', 'communication_address', 'ward', 'aadhar_number', 'driving_license_number', 'pan', 'occupation_id', 'occupation_type', 'job_type_details', 'r_name', 'r_phone', 'r_address', 'r_name1', 'r_phone1', 'r2_address', 'r_others', 'customer_photo', 'customer_aadharr', 'customer_other', 'account_holder_name', 'bank_name', 'account_number', 'ifsc', 'gpay_no', 'location_id', 'status'];


    // Define the relationship with the Loan model
    public function loans()
    {
        return $this->hasMany(Loan::class, 'customer_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'location_id');
    }

    public function loan()
{
    return $this->hasOne(Loan::class, 'customer_id'); // Adjust foreign key if needed
}

public function getUnpaidInterestMonthsAttribute()
{
  $loan = $this->loan;

  if (!$loan) {
      return []; // No loan found, return empty array
  }

  // Get the created date of the loan
  $loanCreatedDate = $loan->created_at;
  // Get the current month and year
  $currentDate = now();

  // Generate a list of all months from loan creation to current month
  $months = [];
  for ($date = $loanCreatedDate; $date <= $currentDate; $date->addMonth()) {
      $months[] = $date->format('Y-m'); // Format as Year-Month (e.g., 2024-11)
  }

  // Get paid months from the loan_interest_payments table
  $paidMonths = LoanInterestPayment::where('loan_id', $loan->loan_number)
      ->pluck('month')
      ->toArray();

  // Filter unpaid months
  $unpaidMonths = array_diff($months, $paidMonths);

  return $unpaidMonths;
}

}
