<?php
namespace App\Traits;

Trait DropDownTrait {
    public function getDropdownFormatedData($data) {
        $data_array= [];
        foreach($data as $key => $row) {
            $data_array[$key]['value'] = $row->id;
            $data_array[$key]['label'] = $row->name;
        }
        return $data_array;
    }
}