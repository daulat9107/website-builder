<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DropDownTrait;

class Firm extends Model
{
    use HasFactory;
    use DropDownTrait;
    protected $fillable = [
        'user_id',
        'group_id',
        'name',
        'code',
        'pan',
        'gstin',
        'mobile',
        'alternative_mobile',
    ];
    public function scopeFirmDropDown() {
        return $this->getDropdownFormatedData(Firm::select('id', 'name')->where('group_id',3)->get());
    }
}
