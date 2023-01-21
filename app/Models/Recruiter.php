<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Recruiter extends Model
{
    use HasFactory;
    use Notifiable;

    protected $guarded = [];

    protected $with = ['user'];

    protected $hidden = ['created_at' , 'updated_at'];


    public static function search()
    {

        $status = false;
        // $approve = false;
        // $connection = false;
        $service = false;
        $sort_field = request('sort')['field'] ?? 'id';
        $sort_type = request('sort')['sort'] ?? 'desc';
        $enum = [0, 1, 2];
        $page = request('pagination')['page'] ?? 1;
        if (request('query')) {

            if (isset(request('query')['filter.status'])) {
                if (in_array(request('query')['filter.status'], $enum))
                    $status = true;
            }

            if (isset(request('query')['filter.service'])) {
                $service = true;
            }
        }
        return self::when(request('query') ? request('query')['user.name, user.phone'] ?? false : false, function ($q) {
            return $q->whereHas('user', function ($qq) {
                $qq->where('users.name', 'like', '%' . request('query')['user.name, user.phone'] . '%')
                    ->orWhere('users.phone', 'like', '%' . request('query')['user.name, user.phone'] . '%');
            });
        })->when($status, function ($q) {
            return $q->where('status', request('query')['filter.status']);
        })->when($service, function ($q) {
            return $q->where('service_id', request('query')['filter.service']);
        })->orderby($sort_field, $sort_type)->paginate(request('pagination')['perpage'] ?? 10, '*', 'page', $page);
    }

    public static function CustomPaginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function getImageAttribute($value)
    {
        return asset('storage' . '/' . $value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function getStatusNameAttribute()
    {
        return $this->status = [
            0 => 'Blocked',
            1 => 'Active'
        ][$this->status];
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

}
