<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    use HasFactory;
     protected $fillable = [
        'member_id',
        'called_by',
        'call_start_time',
        'call_end_time',
        'call_duration',
        'remarks'
    ];
}
