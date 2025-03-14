<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;
    protected $fillable = [
      'description',
      'amount',
      'salary_month',
      'added_by',
      'location',
      'employee_id'
  ];
}
