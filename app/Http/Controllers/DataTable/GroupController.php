<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends DataTableController
{
    protected $allowDeletion = false;
    protected $allowUpdation = false;
    public function builder()
    {
        return Group::query();
    }
    public function getDisplayableColumns()
    {
        return ['id','name'];
    }
    public function hideDisplaybleColumn()
    {
        return ['id'];
    }
    public function getUpdatableColumns()
    {
        return ['name'];
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
            'name'   => [
                'label'       => 'Group Name',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Group Name...',
                'data'        => []
            ]
        ];
    }
    
}