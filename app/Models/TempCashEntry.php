<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use App\Models\User;

class TempCashEntry extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'subtotal', 'amount'];

    public function details()
    {
        return $this->hasMany(TempCashEntryDetail::class);
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
