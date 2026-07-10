<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use App\Models\User;

class CashEntry extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'subtotal', 'date', 'day'];

    public function details()
    {
        return $this->hasMany(CashEntryDetail::class);
    }
     /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap();
    }

    /**
     * create slug
     *
     * @return response()
     */


}
