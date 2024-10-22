<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'group_id',
        'group_user_id',
        'name',
        'account_no',
        'ifsc_code',
        'bank_name',
        'branch_name'
    ];

}