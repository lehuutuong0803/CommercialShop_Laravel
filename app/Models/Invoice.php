<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Base
{
    use HasFactory;

    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $guarded =[];

    public function detailed_invoice(){
        return $this -> hasMany(Detailed_invoice::class,'invoice_dt','id');
    }
    public function user(){
        return $this -> belongsTo(User::class,'user_invoice','id');
    }
    public function listingConfigs(){
        $defaultListingConfigs = parent::defaultListingConfigs();
        $listingConfigs =  array(
            array(
                'field' =>'id',
                'name' => 'ID',
                'type' => 'text',
                'filter' =>'equal'
            ),
            array(
                'field' =>'id_user',
                'name' => 'Id người dùng',
                'type' => 'text',
                'filter' =>'like'
            ),
            array(
                'field' =>'address',
                'name' => 'Địa chỉ giao',
                'type' => 'text'
            ),
            array(
                'field' =>'total',
                'name' => 'Tổng tiền',
                'type' => 'number',
                'filter' =>'between'
            ),
            array(
                'field' =>'quantity',
                'name' => 'Số lượng',
                'type' => 'number'
            ),
            array(
                'field' =>'note',
                'name' => 'Ghi chú',
                'type' => 'text'
            ),
            array(
                'field' =>'status',
                'name' => 'Trạng thái',
                'type' => 'text'
            ),
        );
        return array_merge($listingConfigs,$defaultListingConfigs);
    }
}
