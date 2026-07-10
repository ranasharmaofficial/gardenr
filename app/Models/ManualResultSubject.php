<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class ManualResultSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'result_id', 'subject_code', 'subject_name', 'full_marks',
        'pass_marks', 'marks_obtained', 'grade'
    ];

     /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap();
    }
}
