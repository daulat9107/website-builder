<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $with = ['city','city.state'];
    protected $fillable = [
        'user_id',
        'group_id',
        'group_user_id',
        'name',
        'address',
        'city_id',
        'pincode',
    ];
    public function city() {
        return $this->belongsTo(City::class);
    }
}
