<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Base;
class Product extends Base
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded =[];



    public function category(){
        return $this -> belongsTo(Category::class,'id_category','id');
    }
    public function comment(){
        return $this -> hasMany(Comment::class,'product_comment','id');
    }
    public function detailed_invoice(){
        return $this -> hasMany(Detailed_invoice::class,'product_dt','id');
    }
    public function evaluate(){
        return $this -> hasMany(Evaluate::class,'product_evaluate','id');
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
                'field' =>'name_product',
                'name' => 'Tên sản phẩm',
                'type' => 'text',
                'filter' =>'like',
                'listing' => true,
                'editing' => true,
                'validate' => 'required|max:255'
            ),
            array(
                'field' =>'amount',
                'name' => 'Số lượng',
                'type' => 'number',
                'listing' => true,
                'editing' => true,
                'validate' => 'required|Numeric'

            ),
            array(
                'field' =>'details',
                'name' => 'Mô tả',
                'type' => 'textarea',
                'listing' => true,
                'editing' => true,
                'validate' => 'required'
            ),
            array(
                'field' =>'img',
                'name' => 'Ảnh SP',
                'type' => 'image',
                'listing' => true,
                'editing' => true,
                'validate' => 'required'
            ),
            array(
                'field' =>'import_price',
                'name' => 'Giá nhập',
                'type' => 'number',
                'listing' => true,
                'editing' => true,
                'validate' => 'required|Numeric'
            ),
            array(
                'field' =>'sale_price',
                'name' => 'Giá bán',
                'type' => 'number',
                'filter' =>'between',
                'listing' => true,
                'editing' => true,
                'validate' => 'required|Numeric'
            ),
            array(
                'field' =>'id_category',
                'name' => 'Mã loại',
                'type' => 'foreign_key',
                'listing' => true,
                'editing' => true,
                'validate' => 'required',
                'fkey_value' => 'product'
            ),
            array(
                'field' =>'status',
                'name' => 'Trạng thái',
                'type' => 'number',
                'listing' => true,
                'editing' => true
            )
        );
        return array_merge($listingConfigs,$defaultListingConfigs);
    }
}
