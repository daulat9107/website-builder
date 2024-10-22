<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DropDownTrait;

class Purchaser extends Model
{
    use HasFactory;
    use DropDownTrait;
    protected $fillable = [
        'user_id',
        'firm_id',
        'agency_id',
        'group_id',
        'name',
        'code',
        'pan',
        'gstin',
        'mobile',
        'alternative_mobile',
    ];
   // protected $with = ['firm:id,name','agency:id,name'];
    public function firm() {
        return $this->belongsTo(Firm::class);
    }
    public function agency() {
        return $this->belongsTo(Agency::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function group() {
        return $this->belongsTo(Group::class);
    }
    public function addresses() {
        return $this->hasMany(Address::class,'group_user_id','id');
    }
    public function accounts() {
        return $this->hasMany(Account::class,'group_user_id','id');
    }
    public function transport() {
        return $this->hasMany(Transport::class,'group_user_id','id');
    }
    public function scopePurchasersDropDown() {
        return $this->getDropdownFormatedData(Purchaser::select('id', 'name')->get());
    }
}
