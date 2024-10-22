<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
        protected $fillable = [
        'user_id',
        'order_date',
        'purchaser_id',
        'supplier_id',
        'agency_id',
        'subtotal',
        'total',
        'status',
        'comments',
    ];
    public function purchaser() {
        return $this->belongsTo(Purchaser::class);
    }
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
    public function agency() {
        return $this->belongsTo(Agency::class);
    }
    public function orderProducts() {
        return $this->hasMany(OrderProduct::class);
    }
    public function scopeOrdersDropDown() {
        return $this->getDropdownFormatedData(Order::select('id')->get());
    }
    public function getDropdownFormatedData($data) {
        $data_array= [];
        foreach($data as $key => $row) {
            $data_array[$key]['value'] = $row->id;
            $data_array[$key]['label'] = $row->id;
        }
        return $data_array;
    }
}
