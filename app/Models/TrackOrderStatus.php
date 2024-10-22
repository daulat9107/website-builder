<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackOrderStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'status',
        'comments',
        'status_update_date',
        'status_label'

    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
