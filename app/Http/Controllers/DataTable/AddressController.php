<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use App\Models\Group;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\City;
use App\Traits\GroupDropDownsTrait;

class AddressController extends DataTableController
{
    use GroupDropDownsTrait;
    public function builder()
    {
        return Address::query();
    }
    public function getDisplayableColumns()
    {
        return ['id','name','address','city_id','pincode'];
    }
    public function hideDisplaybleColumn()
    {
        return ['id'];
    }
    public function getUpdatableColumns()
    {
        return ['group_user_id','name','address','city_id','pincode'];
    }
    public function formData(Request $request) 
    {
        $data = [
            'group_user_id' => [
                'label'       => 'Select Group User',
                'name'        => 'group_user_id',
                'type'        => 'select',
                'placeholder' => 'Agency...',
                'data'        => []
            ],
            'name'   => [
                'label'       => 'Address Name',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Address Name...',
                'data'        => []
            ], 
            'address'  => [
                'label'       => 'Address',
                'name'        => 'address',
                'type'        => 'textarea',
                'placeholder' => 'Address...',
                'data'        => []
            ],
            'city_id'  => [
                'label'       => 'City',
                'name'        => 'city_id',
                'type'        => 'select',
                'placeholder' => 'City...',
                'data'        => City::CitiesDropDown()
            ],
            'pincode'  => [
                'label'       => 'Pincode',
                'name'        => 'pincode',
                'type'        => 'number',
                'placeholder' => 'Pincode...',
                'data'        => []
            ]
        ];
        return $this->groupDropDowns($request, $data);
    }    
}