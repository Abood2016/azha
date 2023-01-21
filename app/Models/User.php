<?php

namespace App\Models;

use Gabievi\Promocodes\Traits\Rewardable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWallets;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\CanConfirm;
use Bavix\Wallet\Services\CommonService;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements Wallet
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasWallet;
    use HasWallets;
    use CanConfirm;
    use LaratrustUserTrait;
    use SoftDeletes;

//    protected $with = ['wallet'];
    public $pushNotificationType = 'users';

    public const ROLES = [
        0,  // Super Admin
        1,  // Admin
        2,  // Customer
        3,  // Driver
        4,  // Business
        5, // recruiter
    ];
    protected $dates = ['deleted_at'];
    protected $fillable = [

        'name',
        'email',
        'phone',
        'password',
        'role',
        'is_new',
        'fcm_token',
        'profile_photo_path',
        'push_notification',
        'twitter',
        'snapchat',
        'address',
    ];

    protected $hidden = [
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
        'display_name_role',
    ];

    public static function search($role = 1)
    {

        $status = false;
        $approve = false;
        $connection = false;
        $sort_field = request('sort')['field'] ?? 'id';
        $sort_type = request('sort')['sort'] ?? 'desc';
        $page = request('pagination')['page'] ?? 1;
        return self::where('role', $role)->withTrashed()->when(request('query') ? request('query')['query'] ?? false : false, function ($q) {
            $q->where('name', 'like', '%' . request('query')['query'] . '%')
                ->orWhere('phone', 'like', '%' . request('query')['query'] . '%');
        })->orderBy($sort_field, $sort_type)->paginate(request('pagination')['perpage'] ?? 10, '*', 'page', $page);
    }

    public function getProfilePhotoUrlAttribute($value)
    {
        if (!is_null($this->profile_photo_path))
            return asset('storage/profile-photos/' . $this->profile_photo_path);

        return asset('storage/profile-photos/default.png');
    }

    public function getDisplayNameRoleAttribute($value)
    {

        $roles = Role::all()->pluck('name')->toArray();
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return $role;
            }

        }
        return '';

    }


    public function driver(): hasOne
    {
        return $this->hasOne(Driver::class);
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function recruiter(): HasOne
    {
        return $this->hasOne(Recruiter::class);
    }

    public function generateVerificationCode()
    {
        $this->timestamps = false;
        $this->passphrase = mt_rand(100000, 999999);
        $this->passphrase_expiry = now()->addMinutes(3)->timestamp;
        $this->save();
    }

    public function resetVerificationCode()
    {
        $this->timestamps = false;
        $this->passphrase = null;
        $this->passphrase_expiry = null;
        $this->save();
    }

    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }

    public function getRoleAttribute()
    {
        return self::ROLES[$this->attributes['role']];
    }

    public function scopeAdmin($query)
    {
        return $query->firstWhere('role', 0);
    }

    public function place()
    {
        return $this->hasOne(Place::class);
    }

    public function commissionTransfer(User $last, $commission, $withdrawConfirm = true)
    {
        $this->forceWithdraw($commission, ['data' => 'Commission'], $withdrawConfirm);
        $last->deposit($commission, ['data' => 'Commission'], false);

        return true;
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }
}
