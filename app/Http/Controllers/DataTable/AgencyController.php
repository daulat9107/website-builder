<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use App\Models\Firm;
use App\Models\Agency;
use Illuminate\Http\Request;
use App\Enums\GroupIds;

class AgencyController extends DataTableController
{
    public function builder()
    {
        return Agency::query();
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
        return ['firm_id','name','code','pan','gstin','mobile','alternative_mobile'];
    }
    public function store(Request $request)
    {
        if (!$this->allowCreation) {
            return;
        }

        $this->builder->create(
            array_merge(
                ['user_id'=>$request->user()->id,'group_id' => GroupIds::Agencies], 
                $request->only($this->getUpdatableColumns())
            )
        );
    }
    public function update($id, Request $request)
    {
        $this->builder->find($id)->update(
            array_merge(
                ['user_id'=>$request->user()->id,'group_id' => GroupIds::Agencies], 
                $request->only($this->getUpdatableColumns())
            )
        );
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
            'firm_id' => [
                'label'       => 'Agency Firm',
                'name'        => 'firm_id',
                'type'        => 'select',
                'placeholder' => 'Agency Firm...',
                'data'        => Firm::FirmDropDown()
            ],
            'name'   => [
                'label'       => 'Agency Name',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Agency Name...',
                'data'        => []
            ],
            'code'   => [
                'label'       => 'Agency Code',
                'name'        => 'code',
                'type'        => 'text',
                'placeholder' => 'Agency Code...',
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