<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getLogoAttribute($value)
    {
        return global_asset('storage' . '/' . $value);
    }
}
