<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Spatie\Translatable\HasTranslations;

class Order extends Model
{
    use HasFactory;

//    use \Laravel\Scout\Searchable;


    protected $guarded = [];
    protected $appends = ['status_name'];
    protected $with = ['service'];
    //created_by
    static $FROM_ADMIN = 'admin', $FROM_CUSTOMER = 'customer', $FROM_PLACE = 'place';

    //status
    static $pending = 0, $accept = 1, $cancelByCustomer = 2, $notFoundFirstTime = 3,
        $notFoundTryAgain = 4, $cancelByDriver = 5, $cancelByAdmin = 6, $picked_at = 7, $complete = 8;


    public function activities()
    {
        return $this->hasMany(ActivityOrder::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function pickupable()
    {
        return $this->morphTo()->withTrashed();
    }

    public function customers()
    {
        return $this->morphedByMany(Customer::class, 'orderable');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function drivers()
    {
        return $this->morphedByMany(Driver::class, 'orderable');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getStatusNameAttribute()
    {
        return [
            0 => 'Pending',
            1 => 'Accepted',
            2 => 'Cancel By Customer',
            3 => 'Not Found First Time',
            4 => 'Not Found Try Again',
            5 => 'Cancel By Driver',
            6 => 'Cancel By Admin',
            7 => 'Picked at',
            8 => 'Completed',
        ][$this->status];
    }
}
