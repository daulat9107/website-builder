<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DropDownTrait;

class Group extends Model
{
    use HasFactory;
    use DropDownTrait;
    protected $fillable = [
        'name'
    ];
    public function scopeGroupsDropDown() {
        return $this->getDropdownFormatedData(Group::select('id', 'name')->get());
    }
}
