<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends DataTableController
{
    public function builder()
    {
        return Product::query();
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
        return ['supplier_id','name'];
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
            'supplier_id' => [
                'label'       => 'Select Supplier',
                'name'        => 'supplier_id',
                'type'        => 'select',
                'placeholder' => 'Supplier...',
                'data'        => Supplier::suppliersDropDown()
            ],
            'name'   => [
                'label'       => 'Product Name',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Product Name...',
                'data'        => []
            ]
        ];
    }
    public function getProductBySupplier(Request $request) {

        $products = Product::bySupplier($request->supplier_id);        
        return response()->json([
            'data' =>$products
        ]);
    }  
}