<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DropDownTrait;

class Supplier extends Model
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
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function firm() {
        return $this->belongsTo(Firm::class);
    }
    public function agency() {
        return $this->belongsTo(Agency::class);
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
    public function scopeSuppliersDropDown() {
        return $this->getDropdownFormatedData(Supplier::select('id', 'name')->get());
    }
}
