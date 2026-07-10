<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name','status','created_by'];

    public function subGroups(){
        return $this->hasMany(ExpenseSubGroup::class,'group_id');
    }

    public function expenses(){
        return $this->hasMany(Expense::class,'group_id');
    }
}
