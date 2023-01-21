<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category'];

    public static function search($request)
    {
        $sort_field = $request['sort']['field'] ?? 'id';
        $sort_type = $request['sort']['sort'] ?? 'desc';
        $enum = [0, 1];
        $page = $request['pagination']['page'] ?? 1;
        return self::when($request['query'] ? $request['query']['name,id'] ?? false : false, function ($q) use ($request) {
            return $q->where(DB::raw('lower(name)'), 'like', '%' . strtolower($request['query']['name,id']) . '%')
                ->orWhere('key', 'like', '%' . $request['query']['name,id'] . '%')
                ->orWhere('id', $request['query']['name,id']);
        })->orderBy($sort_field, $sort_type)->paginate($request['pagination']['perpage'] ?? 10, '*', 'page', $page);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
