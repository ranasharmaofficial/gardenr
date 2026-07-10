<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $primaryKey   =   'id';

    protected $fillable = [
        'semester',
        'course_id',
        'sub_course_id',
        'name',
        'subject_code',
        'full_marks',
        'pass_marks',
        'status',
        'created_at',
        'updated_at',
    ];
}
