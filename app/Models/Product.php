<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'supplier_id',
        'name'
    ];
    public function scopeProductsDropDown() {
        return $this->getDropdownFormatedData(
            Product::select('id','name')->get()
        );
    }
    public function getDropdownFormatedData($data) {
        $data_array= [];
        foreach($data as $key => $row) {
            $data_array[$key]['value'] = $row->id;
            $data_array[$key]['label'] = $row->name;
        }
        return $data_array;
    }
    public function scopeBySupplier(Builder $query,$supplier_id): array
    {
        return $this->getDropdownFormatedData(
            $query->where('supplier_id',$supplier_id)->get()
        ); 
    }
}
