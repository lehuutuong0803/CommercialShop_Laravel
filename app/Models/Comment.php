<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Base
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $guarded =[];

    public function product(){
        return $this -> belongsTo(Product::class, 'product_comment', 'id');
    }
    public function user(){
        return $this -> belongsTo(User::class, 'user_comment', 'id');
    }
    public function listingConfigs(){
        $defaultListingConfigs = parent::defaultListingConfigs();
        $listingConfigs =  array(
            array(
                'field' =>'id',
                'name' => 'ID',
                'type' => 'text'
            ),
            array(
                'field' =>'content',
                'name' => 'Nội dung',
                'type' => 'text'
            ),
            array(
                'field' =>'id_user',
                'name' => 'ID người dùng',
                'type' => 'text',
                'filter' =>'equal'
            ),

            array(
                'field' =>'id_product',
                'name' => 'ID sản phẩm',
                'type' => 'text',
                'filter' =>'like'
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
