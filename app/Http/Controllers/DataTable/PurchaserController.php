<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use App\Models\Purchaser;
use App\Models\Firm;
use App\Models\Agency;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Enums\GroupIds;

class PurchaserController extends DataTableController
{
    public function builder()
    {
        return Purchaser::query();
    }
    public function getFetchableColumns()
    {
        return ['id','firm_id','agency_id','name','code','pan','mobile','alternative_mobile','gstin'];
    }

    public function getDisplayableColumns()
    {
        return ['id','firm.name','agency.name','name','code','pan','mobile','alternative_mobile','gstin'];
    }
    public function hideDisplaybleColumn()
    {
        return ['id'];
    }
    public function getUpdatableColumns()
    {
        return ['name','code','pan','mobile','alternative_mobile','gstin'];
    }
    public function getCreateableColumns()
    {
        return ['id','firm_id','agency_id','name','code','pan','mobile','alternative_mobile','gstin'];
    }
    public function store(Request $request)
    {
        if (!$this->allowCreation) {
            return;
        }

        $this->builder->create(
            array_merge(
                ['user_id'=>$request->user()->id,'group_id' => GroupIds::Purchasers], 
                $request->only($this->getCreateableColumns())
            )
        );
    }
    public function update($id, Request $request)
    {
        $this->builder->find($id)->update(
            array_merge(
                ['user_id'=>$request->user()->id,'group_id' => GroupIds::Purchasers], 
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
            return $builder->limit($request->limit)->orderBy(...$this->orderBy($request))->get($this->getFetchableColumns())->map(function ($item) {

                $new_array = [];
                foreach($this->getDisplayableColumns() as $column) {
                     $column_depth = explode('.',$column);
                   if(count($column_depth)>1){
                        $new_array[$column] = $item[$column_depth[0]][$column_depth[1]];
                    }else{
                        $new_array[$column] = $item[$column_depth[0]];
                    }
                }
                return $new_array;
            });

        } catch (QueryException $e) {
            return [];
        }
    }
    public function formData(Request $request) 
    {
        return [
            'firm_id' => [
                'label'       => 'Purchaser Firm',
                'name'        => 'firm_id',
                'type'        => 'select',
                'placeholder' => 'Purchaser Firm...',
                'data'        => Firm::firmDropDown()
            ],
            'agency_id' => [
                'label'       => 'Agency',
                'name'        => 'agency_id',
                'type'        => 'select',
                'placeholder' => 'Agency...',
                'data'        => Agency::agenciesDropDown()
            ],
            'name'   => [
                'label'       => 'Purchaser Name',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Purchaser Name...',
                'data'        => []
            ],
            'code'   => [
                'label'       => 'Purchaser Code',
                'name'        => 'code',
                'type'        => 'text',
                'placeholder' => 'Purchaser Code...',
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