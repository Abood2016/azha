<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Service extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    protected $with = ['recruiter', 'category', 'subcategory'];

    protected $hidden = ['created_at' , 'updated_at'];

    protected $appends = ['image_path'];

    static $pending = 0, $accept = 1, $cancelByAdmin = 2;

    public static function search()
    {

        $sort_field = request('sort')['field'] ?? 'id';
        $sort_type = request('sort')['sort'] ?? 'desc';
        return self::when(request('query') ? request('query')['name'] ?? false : false, function ($q) {
            return $q->where('name', 'like', '%' . request('query')['name'] . '%')
                ->orWhere('id', request('query')['name']);
        })->orderby($sort_field, $sort_type)->paginate(request('perpage') ?? 10);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(Recruiter::class);
    }

    public function getStatusNameAttribute()
    {
        return $this->status = [
            0 => 'Blocked',
            1 => 'Active'
        ][$this->status];
    }


    public function getImagePathAttribute()
    {
        if(!empty($this->image)){
            return asset('storage/services' . '/' . $this->image);
        }
        return null;
    }
}
