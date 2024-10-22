<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use Illuminate\Http\Request;
use App\Models\Purchaser;
use App\Models\Supplier;
use App\Models\Agency;
use App\Traits\GroupDropDownsTrait;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\TrackOrderStatus;

class OrdersController extends DataTableController
{
    public function builder()
    {
        return Order::query();
    }
    public function getFetchableColumns()
    {
        return ['id','order_date','purchaser_id','supplier_id','agency_id','subtotal','total','status','comments'];
    }
    public function getDisplayableColumns()
    {
        return ['id','order_date','purchaser.name','supplier.name','agency.name','subtotal','total','status','comments'];
    }
    public function hideDisplaybleColumn()
    {
        return [];
    }
    public function getUpdatableColumns()
    {
        return ['order_date','purchaser_id','supplier_id','agency_id','subtotal','total','status','comments'];
    }
    public function store(Request $request)
    {
        if (!$this->allowCreation) {
            return;
        }
        $id = $this->builder->create(
            array_merge(
                ['user_id'=>$request->user()->id], 
                $request->only($this->getUpdatableColumns())
            )
        )->id;
        $products = $request->products;
        foreach($products as $product) {
            OrderProduct::create(
                array_merge([
                    'user_id'=>$request->user()->id,
                    'order_id' => $id
                ],$product)
            );
        }
        $status=explode('-',$request->status);
        if(isset($status[1])){
            $status_label = ucfirst($status[0]).' '.ucfirst($status[1]);
        }else{
            $status_label = ucfirst($status[0]);
        }
        TrackOrderStatus::create([
            'user_id'=> $request->user()->id,
            'order_id'=> $id,
            'status_update_date'=> $request->order_date,
            'status_label'=> $status_label,
            'status'=> $request->status,
            'comments'=> $request->comments
        ]);
    }
    public function update($id, Request $request)
    {
        $this->builder->find($id)->update(
            array_merge(
                ['user_id'=>$request->user()->id], 
                $request->only($this->getUpdatableColumns())
            )
        );
        $status=explode('-',$request->status);
        if(isset($status[1])){
            $status_label = ucfirst($status[0]).' '.ucfirst($status[1]);
        }else{
            $status_label = ucfirst($status[0]);
        }
        
        TrackOrderStatus::create([
            'user_id'=> $request->user()->id,
            'order_id'=> $id,
            'status_update_date'=> $request->order_date,
            'status_label'=> $status_label,
            'status'=> $request->status,
            'comments'=> $request->comments
        ]);

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
                     $column_depth = explode('.',$column);;
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
            'order_date' => [
                'label'       => 'Order Date',
                'name'        => 'order_date',
                'type'        => 'datetime-local',
                'placeholder' => 'Order Date...',
                'required'    => true

            ],
            'purchaser_id' => [
                'label'       => 'Select Purchaser',
                'name'        => 'purchaser_id',
                'type'        => 'select',
                'placeholder' => 'Purchaser...',
                'data'        => Purchaser::purchasersDropDown(),
                'required'    => true

            ],
            'supplier_id' => [
                'label'       => 'Select Supplier',
                'name'        => 'supplier_id',
                'type'        => 'select',
                'placeholder' => 'Supplier...',
                'data'        => Supplier::suppliersDropDown(),
                'required'    => true

            ],
            'agency_id' => [
                'label'       => 'Select Agency',
                'name'        => 'agency_id',
                'type'        => 'select',
                'placeholder' => 'Agency...',
                'data'        => Agency::agenciesDropDown(),
                'required'    => true

            ],
            'subtotal' => [
                'label'       => 'Sub Total ',
                'name'        => 'subtotal',
                'type'        => 'text',
                'placeholder' => '(without taxes, discount, shipping, etc.)...',
                'required'    => true

            ],
            'total'  => [
                'label'       => 'Total',
                'name'        => 'total',
                'type'        => 'text',
                'placeholder' => '(including additional order line items)...',
                'required'    => true
            ],
            'status'  => [
                'label'       => 'Order Status',
                'name'        => 'status',
                'type'        => 'select',
                'placeholder' => 'Order Status...',
                'required'    => true,
                'data'        => [
                    [
                        'label'=>'Cancelled',
                        'value' =>'cancelled'
                    ],
                    [
                        'label'=>'Pending',
                        'value' =>'pending'
                    ],
                    [
                        'label'=>'Pending Payment',
                        'value' =>'pending-payment'
                    ],
                    [
                        'label'=>'Completed',
                        'value' =>'completed'
                    ],
                    [
                        'label'=>'Refunded',
                        'value' =>'refunded'
                    ],
                    [
                        'label'=>'On hold',
                        'value' =>'on-hold'
                    ],
                    [
                        'label'=>'Shipped',
                        'value' =>'shipped'
                    ],
                    [
                        'label'=>'Failed',
                        'value' =>'failed'
                    ],
                    [
                        'label'=>'Processing',
                        'value' =>'processing'
                    ],
                    [
                        'label'=>'Paid',
                        'value' =>'paid'
                    ],
                    [
                        'label'=>'Awaiting shipment',
                        'value' =>'awaiting-shipment'
                    ],
                    [
                        'label'=>'Delivered',
                        'value' =>'delivered'
                    ],
                    [
                        'label'=>'Awaiting fulfillment',
                        'value' =>'awaiting-fulfillment'
                    ],
                    [
                        'label'=>'Fulfilled',
                        'value' =>'fulfilled'
                    ],
                    [
                        'label'=>'Partially paid',
                        'value' =>'partially-paid'
                    ]
                ]
            ],
            'comments'  => [
                'label'       => 'Comments',
                'name'        => 'comments',
                'type'        => 'textarea',
                'placeholder' => 'Comments...',
                'required'    => true
            ]
        ];
    }    
}