<?php

namespace App\Http\Controllers\DataTable;


use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use App\Models\Transport;
use Illuminate\Http\Request;
use App\Models\Agency;
use App\Traits\GroupDropDownsTrait;

class TransportController extends DataTableController
{
    use GroupDropDownsTrait;
    public function builder()
    {
        return Transport::query();
    }
    public function getDisplayableColumns()
    {
        return ['id','name','mobile'];
    }
    public function hideDisplaybleColumn()
    {
        return ['id'];
    }
    public function getUpdatableColumns()
    {
        return ['group_user_id','name','mobile','alternative_mobile'];
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
                'label'       => 'Transport Name',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Transport Name...',
                'data'        => []
            ],
            'mobile'  => [
                'label'       => 'Mobile',
                'name'        => 'mobile',
                'type'        => 'text',
                'placeholder' => 'Mobile...',
                'data'        => []
            ],
            'alternative_mobile'  => [
                'label'       => 'Alternative Mobile',
                'name'        => 'alternative_mobile',
                'type'        => 'text',
                'placeholder' => 'Alternative Mobile...',
                'data'        => []
            ]
        ];
        return $this->groupDropDowns($request, $data);
    }    
}