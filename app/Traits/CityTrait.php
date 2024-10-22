<?php
namespace App\Traits;
use App\Models\State;
use App\Models\City;

trait CityTrait {
    public function scopeCitiesDropDown() {
        $state_ids=State::select('id')->where('country_id',101)->get()->pluck('id');
        return $this->getDropdownFormatedData(
            City::select('id', 'name')->whereIn('state_id',$state_ids)->get());
    }
}