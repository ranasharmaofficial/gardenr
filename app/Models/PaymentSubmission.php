<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class PaymentSubmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'date',
        'day',
        'time',
        'total_amount',
        'no_of_screenshot',
        'status',
        'created_at',
        'updated_at',

    ];

    public function screenshots()
    {
        return $this->hasMany(PaymentScreenshot::class, 'payment_id');
    }

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
