<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['expense_type_id', 'date', 'amount', 'description', 'added_by', 'updated_by', 'deleted_by', 'expenses_date','location'];

    public function expenseType()
    {
        return $this->belongsTo(OfficeExpenseType::class);
    }
}
