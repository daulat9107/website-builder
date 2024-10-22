<?php
namespace App\Traits;
use App\Models\Agency;
use App\Models\Purchaser;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Enums\GroupIds;

Trait GroupDropDownsTrait {
    public function groupDropDowns(Request $request,$data) {

        if($request->group_id == GroupIds::Purchasers){
            $data['group_user_id']['placeholder'] = 'Purchaser...';
            $data['group_user_id']['data'] = Purchaser::purchasersDropDown();
        }

        if($request->group_id == GroupIds::Suppliers){
            $data['group_user_id']['placeholder'] = 'Supplier...';
            $data['group_user_id']['data'] = Supplier::suppliersDropDown();
        }

        if($request->group_id == GroupIds::Agencies){
            $data['group_user_id']['placeholder'] = 'Purchaser...';
            $data['group_user_id']['data'] = Agency::agenciesDropDown();
        }
        return $data;
    }
}