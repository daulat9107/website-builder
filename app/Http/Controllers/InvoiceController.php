<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Supplier;
use App\Models\Purchaser;
use App\Models\Agency;
use App\Traits\DropDownTrait;

class InvoiceController extends Controller
{
    use DropDownTrait;
    public function create() {

        $suppliers = Supplier::with(
            [
                'firm',
                'addresses' => function ($query){
                    $query->where('group_id',2)->where('name','like','%primary%');
                },
                'accounts' => function ($query){
                    $query->where('group_id',2)->where('name','like','%primary%');
                },
                'user',
                'agency'=>[
                    'firm',
                    'addresses' => function ($query){
                    $query->where('group_id',3)->where('name','like','%primary%');
                },
                'accounts' => function ($query){
                    $query->where('group_id',3)->where('name','like','%primary%');
                },
                ],
                'group'
            ]
        )
        ->get();
        $suppliersDropDown = $this->getDropdownFormatedData($suppliers);
        $purchasers = Purchaser::with([
            'firm',
            'user',
            'agency',
            'group',
            'transport'
        ])->get();
        $purchasersDropDown = $this->getDropdownFormatedData($purchasers);

        return Inertia::render('Invoice',[
            'suppliers' => $suppliers,
            'purchasers' => $purchasers,
            'suppliersDropDown' => $suppliersDropDown,
            'purchasersDropDown' => $purchasersDropDown,
        ]);
    }
}
