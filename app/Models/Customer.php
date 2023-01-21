<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use HasFactory;
    use Notifiable;
    protected $guarded = [];

    protected $with = ['user'];

    public static function search($data){
        if($data && $data['is_vuejs']){
            return self::when($data['query'], function ($q) use ($data) {
                return $q->whereHas('user', function ($qq) use ($data){
                    $qq->where('users.name','like', '%' . $data['query'] . '%')
                        ->orWhere('users.phone','like', '%' . $data['query']. '%')
                    ;
                });
            })->paginate(10);
        }else{
            $status = false; $gender = false;
            $sort_field  = request('sort')['field']??'id';
            $sort_type  = request('sort')['sort']??'desc';
            $enum = [0,1,2];
            $page = request('pagination')['page']??1;
            if(request('query')){
                if(isset(request('query')['gender'])){
                    if(in_array(request('query')['gender'],$enum))
                        $gender = true;
                }
                if(isset(request('query')['status'])){
                    if(in_array(request('query')['status'],$enum))
                        $status = true;
                }

            }
            return self::when(request('query')?request('query')['user.name, user.phone']??false:false, function ($q)  {
                return $q->whereHas('user', function ($qq){
                    $qq->where('users.name','like', '%' . request('query')['user.name, user.phone'] . '%')
                        ->orWhere('users.phone','like', '%' . request('query')['user.name, user.phone'] . '%')
                    ;
                });
            })->when($gender, function ($q) use($gender)  {
                return $q->where('gender',request('query')['gender']);
            })->when($status, function ($q)  {
                return   $q->where('status',request('query')['status']);
            })->orderby($sort_field,$sort_type)->paginate(request('pagination')['perpage']??10,'*','page',$page);
        }

    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(CustomerNotification::class);
    }

    public function getOrdersAttribute()
    {
        return $this->orders();
    }

    public function scopeActive()
    {
        return self::where('status', 1);
    }

    public function getStatusNameAttribute()
    {
        return $this->status = [
            0 => 'Blocked',
            1 => 'Active'
        ][$this->status];
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

}
