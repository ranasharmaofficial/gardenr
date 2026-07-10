<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
     protected $fillable = [
        'group_id','sub_group_id','title','description','amount',
        'expense_date','payment_mode','bill_file','status','created_by'
    ];

    public function group(){
        return $this->belongsTo(ExpenseGroup::class,'group_id');
    }

    public function subGroup(){
        return $this->belongsTo(ExpenseSubGroup::class,'sub_group_id');
    }
}
