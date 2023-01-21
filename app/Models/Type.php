<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

class Type extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded = [];
    protected $appends = ['image_path'];

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

    public function getImagePathAttribute()
    {
        if ($this->image == 'https://icons.iconarchive.com/icons/guillendesign/variations-3/256/Default-Icon-icon.png')
            return 'https://icons.iconarchive.com/icons/guillendesign/variations-3/256/Default-Icon-icon.png';
        return asset('storage/types/' . $this->image);
    }

    public function places()
    {
        return $this->belongsToMany(Place::class, 'place_types');
    }
}
