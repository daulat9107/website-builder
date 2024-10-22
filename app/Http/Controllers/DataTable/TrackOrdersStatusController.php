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
use App\Models\TrackOrderStatus;

class TrackOrdersStatusController extends DataTableController
{
    protected $allowCreation = false;
    protected $allowDeletion = false;
    protected $allowUpdation = false;

    public function builder()
    {
        return TrackOrderStatus::query();
    }
    public function getFetchableColumns()
    {
        return ['id','order_id','user_id','status','comments','status_label','status_update_date'];
    }
    public function getDisplayableColumns()
    {
        return ['id','order_id','user.name','status','comments','status_label','status_update_date'];
    }
    public function hideDisplaybleColumn()
    {
        return [];
    }
    public function getUpdatableColumns()
    {
        return [];
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
}