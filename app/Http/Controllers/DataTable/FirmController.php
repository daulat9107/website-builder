<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use App\Models\Firm;
use App\Models\Agency;
use Illuminate\Http\Request;
use App\Models\Group;

class FirmController extends DataTableController
{
    public function builder()
    {
        return Firm::query();
    }
    public function getDisplayableColumns()
    {
        return ['id','name','mobile','gstin'];
    }
    public function hideDisplaybleColumn()
    {
        return ['id'];
    }
    public function getUpdatableColumns()
    {
        return ['group_id','name','code','pan','gstin','mobile','alternative_mobile'];
    }
    public function getRecords(Request $request)
    {
        $builder = $this->builder;
        if ($this->hasSearchQuery($request)) {
            $builder = $this->buildSearch($builder, $request);
        }
        try {
            return $builder->limit($request->limit)->orderBy(...$this->orderBy($request))->get($this->getDisplayableColumns());
        } catch (QueryException $e) {
            return [];
        }
    }
    public function formData(Request $request) 
    {
        return [
            'group_id'   => [
                'label'       => 'Group Name',
                'name'        => 'group_id',
                'type'        => 'select',
                'placeholder' => 'Group Name...',
                'data'        => Group::groupsDropDown(),
            ],
            'name'   => [
                'label'       => 'Firm Name',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Firm Name...',
                'data'        => []
            ],
            'code'   => [
                'label'       => 'Firm Code',
                'name'        => 'code',
                'type'        => 'text',
                'placeholder' => 'Firm Code...',
                'data'        => []
            ],
            'pan'    => [
                'label'       => 'PAN',
                'name'        => 'pan',
                'type'        => 'text',
                'placeholder' => 'PAN Number...',
                'data'        => []
            ],
            'gstin'  => [
                'label'       => 'GSTIN',
                'name'        => 'gstin',
                'type'        => 'text',
                'placeholder' => 'GSTIN...',
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
    }    
}