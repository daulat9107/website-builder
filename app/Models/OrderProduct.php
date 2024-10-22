<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
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
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
