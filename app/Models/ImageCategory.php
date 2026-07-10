<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ImageCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'parent_id',
        'status',
        'created_by'
    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination

        static::created(function ($post) {
            $post->slug = $post->createSlug($post->title);
            $post->save();
        });
    }
    /**
     * create slug
     *
     * @return response()
     */
    private function createSlug($title)
    {
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::whereTitle($title)->latest('id')->skip(1)->value('slug');

            if (is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }

            return "{$slug}-2";
        }

        return $slug;
    }
}
