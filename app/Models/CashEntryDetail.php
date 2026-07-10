<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use App\Models\User;

class CashEntryDetail extends Model
{
    use HasFactory;
    protected $fillable = ['cash_entry_id', 'note_value', 'quantity', 'total'];

    public function entry()
    {
        return $this->belongsTo(CashEntry::class);
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
