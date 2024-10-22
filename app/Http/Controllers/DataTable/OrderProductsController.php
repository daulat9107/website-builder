<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use Illuminate\Http\Request;
use App\Models\Purchaser;
use App\Models\Supplier;
use App\Models\Agency;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Product;

class OrderProductsController extends DataTableController
{
    public function builder()
    {
        return OrderProduct::query();
    }
    public function getFetchableColumns()
    {
        return [
            'id',
            'order_id',
            'user_id',
            'product_id',
            'unit',
            'qty',
            'rate',
            'discount',
            'taxable',
            'gst',
            'cgst',
            'sgst',
            'amount'

        ];
    }
    public function getDisplayableColumns()
    {
        return [
            'id',
            'order_id',
            'user.name',
            'product.name',
            'unit',
            'qty',
            'rate',
            'discount',
            'taxable',
            'gst',
            'cgst',
            'sgst',
            'amount',
        ];
    }
    public function hideDisplaybleColumn()
    {
        return [];
    }
    public function getUpdatableColumns()
    {
        return [
            'id',
            'order_id',
            'user_id',
            'product_id',
            'unit',
            'qty',
            'rate',
            'discount',
            'taxable',
            'gst',
            'cgst',
            'sgst',
            'amount',
        ];
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
            'order_id' => [
                'label'       => 'Order Id',
                'name'        => 'order_id',
                'type'        => 'select',
                'placeholder' => 'Order Date...',
                 'data'       => Order::OrdersDropDown()

            ],
            'product_id' => [
                'label'       => 'Select Product',
                'name'        => 'product_id',
                'type'        => 'select',
                'placeholder' => 'Product...',
                'data'        => Product::productsDropDown()

            ],
            'unit' => [
                'label'       => 'Select Unit',
                'name'        => 'unit',
                'type'        => 'select',
                'placeholder' => 'Unit...',
                'data'        => [
                    ['label'=>'PCS','value' =>'pcs'],
                    ['label'=>'Kg','value' =>'kg'],
                    ['label'=>'M','value' =>'m'],
                    ['label'=>'Than','value' =>'than'],
                    ['label'=>'Lump','value' =>'lump'],
                ]

            ],
            'qty' => [
                'label'       => 'Qty',
                'name'        => 'qty',
                'type'        => 'text',
                'placeholder' => 'Qty...',
            ],
            'rate' => [
                'label'       => 'Rate',
                'name'        => 'rate',
                'type'        => 'text',
                'placeholder' => 'Rate...',
            ],
            'discount' => [
                'label'       => 'Discount',
                'name'        => 'discount',
                'type'        => 'text',
                'placeholder' => 'Discount...',
            ],
            'taxable' => [
                'label'       => 'Taxable',
                'name'        => 'taxable',
                'type'        => 'text',
                'placeholder' => 'Taxable...',
            ],
            'gst' => [
                'label'       => 'GST',
                'name'        => 'gst',
                'type'        => 'text',
                'placeholder' => 'GST(in %)...',
            ],
            'sgst' => [
                'label'       => 'SGST',
                'name'        => 'sgst',
                'type'        => 'text',
                'placeholder' => 'SGST...',
            ],
            'cgst' => [
                'label'       => 'CGST',
                'name'        => 'cgst',
                'type'        => 'text',
                'placeholder' => 'CGST...',
            ],
            'amount' => [
                'label'       => 'Amount',
                'name'        => 'amount',
                'type'        => 'text',
                'placeholder' => 'Amount...',
            ]
        ];
    }  
}