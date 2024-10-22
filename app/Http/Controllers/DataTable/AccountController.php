<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Requests\StorePartyRequest;
use App\Http\Requests\UpdatePartyRequest;
use App\Http\Controllers\DataTable\DataTableController;
use App\Models\Account;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Traits\GroupDropDownsTrait;

class AccountController extends DataTableController
{
    use GroupDropDownsTrait;
    public function builder()
    {
        return Account::query();
    }
    public function getDisplayableColumns()
    {
        return ['id','name','account_no','ifsc_code','bank_name','branch_name'];
    }
    public function hideDisplaybleColumn()
    {
        return ['id'];
    }
    public function getUpdatableColumns()
    {
        return ['group_id','group_user_id','name','account_no','ifsc_code','bank_name','branch_name'];
    }
    public function formData(Request $request) 
    {
        $data = [
            'group_id' => [
                'label'       => 'Select Group',
                'name'        => 'group_id',
                'type'        => 'select',
                'placeholder' => 'Group...',
                'data'        => Group::groupsDropDown(),
                'selected'    => $request->group_id

            ],
            'group_user_id' => [
                'label'       => 'Select Group User',
                'name'        => 'group_user_id',
                'type'        => 'select',
                'placeholder' => 'Agency...',
                'data'        => []
            ],
            'name'   => [
                'label'       => 'Account Name',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Account Name...',
                'data'        => []
            ], 
            'account_no'  => [
                'label'       => 'Account No',
                'name'        => 'account_no',
                'type'        => 'number',
                'placeholder' => 'Account No...',
                'data'        => []
            ],
            'ifsc_code'  => [
                'label'       => 'IFSC Code',
                'name'        => 'ifsc_code',
                'type'        => 'text',
                'placeholder' => 'Secondary IFSC Code...',
                'data'        => []
            ],
            'bank_name'  => [
                'label'       => 'Bank Name',
                'name'        => 'bank_name',
                'type'        => 'text',
                'placeholder' => 'Bank Name...',
                'data'        => []
            ],
            'branch_name'  => [
                'label'       => 'Branch Name',
                'name'        => 'branch_name',
                'type'        => 'text',
                'placeholder' => 'Branch Name...',
                'data'        => []
            ],
        ];
        
        return $this->groupDropDowns($request, $data);
    }    
}