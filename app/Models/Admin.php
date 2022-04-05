<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Admin extends Base implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;

    public function listingConfigs(){
        $defaultListingConfigs = parent::defaultListingConfigs();
        $listingConfigs =  array(
            array(
                'field' =>'id',
                'name' => 'ID',
                'type' => 'text'
            ),
            array(
                'field' =>'name',
                'name' => 'Tên người dùng',
                'type' => 'text'
            ),
            array(
                'field' =>'email',
                'name' => 'Email',
                'type' => 'text'
            ),
            array(
                'field' =>'address',
                'name' => 'Địa chỉ',
                'type' => 'text'
            ),
            array(
                'field' =>'password',
                'name' => 'Mật khẩu',
                'type' => 'text'
            ),
            array(
                'field' =>'number_phone',
                'name' => 'Số điện thoại',
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
