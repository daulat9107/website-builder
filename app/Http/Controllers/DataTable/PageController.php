<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends DataTableController
{
    protected $allowDeletion = false;
    protected $allowUpdation = false;
    public function builder()
    {
        return Page::query();
    }
    public function getDisplayableColumns()
    {
        return ['id','name','link'];
    }
    public function hideDisplaybleColumn()
    {
        return ['id'];
    }
    public function getUpdatableColumns()
    {
        return ['name','link'];
    }
    public function store(Request $request)
    {
        if (!$this->allowCreation) {
            return;
        }

        $this->builder->create($request->only($this->getUpdatableColumns()));
    }
    public function update($id, Request $request)
    {
        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
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
                'label'       => 'Page Name',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Page Name...',
                'data'        => []
            ],
            'link'   => [
                'label'       => 'Page Link',
                'name'        => 'link',
                'type'        => 'text',
                'placeholder' => 'Page Link...',
                'data'        => []
            ]
        ];
    }
    
}