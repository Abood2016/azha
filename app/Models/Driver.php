<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Notifications\Notifiable;

class Driver extends Model
{
    use HasFactory;
    use Notifiable;

    protected $guarded = [];

    protected $with = ['user', 'service'];
    protected $appends = ['orders_count'];

    protected $casts = [
        'coordinates' => 'array'
    ];

    public static function search()
    {

        $status = false;
        $approve = false;
        $connection = false;
        $service = false;
        $sort_field = request('sort')['field'] ?? 'id';
        $sort_type = request('sort')['sort'] ?? 'desc';
        $enum = [0, 1, 2];
        $page = request('pagination')['page'] ?? 1;
        if (request('query')) {
            if (isset(request('query')['filter.approve'])) {
                if (in_array(request('query')['filter.approve'], $enum))
                    $approve = true;
            }
            if (isset(request('query')['filter.status'])) {
                if (in_array(request('query')['filter.status'], $enum))
                    $status = true;
            }
            if (isset(request('query')['filter.connection'])) {
                if (in_array(request('query')['filter.connection'], $enum))
                    $connection = true;
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
        })->when($approve, function ($q) use ($approve) {
            return $q->where('approve', request('query')['filter.approve']);
        })->when($connection || session('offline'), function ($q) {
            return $q->where('connection', session('offline') ? 0 : request('query')['filter.connection']);
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable');
    }

    public function getOrdersCountAttribute()
    {
        return $this->orders()
            ->count();
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(DriverNotification::class);
    }
//
//    public function getOrdersAttribute()
//    {
//        return $this->orders();
//    }

    public function getBalanceAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getStatusNameAttribute()
    {
        return $this->status = [
            0 => 'Blocked',
            1 => 'Active'
        ][$this->status];
    }

    public function getApproveNameAttribute()
    {
        return $this->approve = [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Declined'
        ][$this->status];
    }

    public function averageRating()
    {
        return number_format($this->ratings()->avg('rating'));
    }

    public function getImageAttribute($value)
    {
        return asset('storage' . '/' . $value);
    }

    public function scopeAvailableActiveDrivers()
    {
        return self::where('connection', 1)
            ->where('available', 1)
            ->where('approve', 1)
            ->where('status', 1);
    }

    public function scopeActiveDrivers()
    {
        return self::where('connection', 1)
            ->where('approve', 1)
            ->where('status', 1);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getCommissions()
    {
        return $this->payments()->where('is_paid', 0)->sum('commission');
    }

    public function getRevenue()
    {
        return $this->payments()->sum('amount');
    }
}
