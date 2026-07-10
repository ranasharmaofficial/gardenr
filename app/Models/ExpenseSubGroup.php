<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseSubGroup extends Model
{
    use HasFactory;
    protected $fillable = ['group_id','name','status','created_by'];

    public function group(){
        return $this->belongsTo(ExpenseGroup::class,'group_id');
    }

    public function expenses(){
        return $this->hasMany(Expense::class,'sub_group_id');
    }
}
