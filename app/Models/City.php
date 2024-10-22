<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CityTrait;
use App\Traits\DropDownTrait;

class City extends Model
{
    use HasFactory;
    use DropDownTrait;
    use CityTrait;
    public function state() {
        return $this->belongsTo(State::class);
    }
}
