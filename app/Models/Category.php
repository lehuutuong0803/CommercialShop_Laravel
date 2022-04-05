<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Base
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $guarded =[];

    public function product(){
        return $this -> hasMany(Product::class,'id_category','id');
    }


    public function Configs(){
        $defaultListingConfigs = parent::defaultListingConfigs();
        $listingConfigs =  array(
            array(
                'field' =>'id',
                'name' => 'ID',
                'type' => 'text',
                'filter' =>'equal',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'name_cate',
                'name' => 'Tên loại',
                'type' => 'text',
                'filter' =>'like',
                'listing' => true,
                'editing' => true
            ),
            array(
                'field' =>'details',
                'name' => 'Chi tiết',
                'type' => 'textarea',
                'listing' => true,
                'editing' => true
            ),

        );
        return array_merge($listingConfigs,$defaultListingConfigs);
    }
}
