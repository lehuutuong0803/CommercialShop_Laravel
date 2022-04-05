<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cookie;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'number_phone',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function  getRecord($condition){
        return self::where($condition)->paginate(1);
    }
    public  function  getFilter($request, $configs,$modelName){
        $condition =[];

        if($request ->method() == "POST"){
            foreach ($configs as $config){
                if(!empty($config['filter'])){
                    $value =$request->input($config['field']);
                    switch ($config['filter']){
                        case "equal":
                            if(!empty(@$value)){
                                $condition[] =[
                                    'field'=> $config['field'],
                                    'condition' => '=',
                                    'value' => $value
                                ];
                            }
                            break;
                        case "like":
                            if(!empty(@$value)){
                                $condition[] =[
                                    'field'=> $config['field'],
                                    'condition' => 'like',
                                    'value' => '%'.$value.'%'
                                ];
                                break;
                            }

                        case "between":
                            if(!empty(@$value['from'])){
                                $condition[] =[
                                    'field'=> 'sale_price',
                                    'condition' => '>=',
                                    'value' => $value['from']
                                ];
                            }
                            if(!empty(@$value['to'])){
                                $condition[] =[
                                    'field'=> 'sale_price',
                                    'condition' => '<=',
                                    'value' => $value['to']
                                ];
                            }
                            break;
                    }

                }
            }
            if(!empty($condition)){
                foreach ($condition as &$condtion){
                    $condtion = (array) $condtion;
                    foreach ($configs as &$config){
                        if($config['field'] == $condtion['field']){
                            switch ($config['filter']){
                                case "equal":
                                    $config['filter_value'] = $condtion['value'];
                                    break;
                                case "like":
                                    $config['filter_value'] = str_replace("%","",$condtion['value']);
                                    break;
                                case "between":
                                    if($condtion['condition'] ==">="){
                                        $config['filter_from_value'] = $condtion['value'];
                                    }else{
                                        $config['filter_to_value'] = $condtion['value'];
                                    }
                                    break;
                            }
                        }
                    }
                }
                Cookie::queue(strtolower($modelName).'_filter', json_encode($condition), 24 * 60);
                //Cookie 24hours
            }
        }else{ //Method: Get
            $condition = json_decode(Cookie::get(strtolower($modelName).'_filter'));
            if(!empty($condition)){
                foreach ($condition as &$condtion){
                    $condtion = (array) $condtion;
                    foreach ($configs as &$config){
                        if($config['field'] == $condtion['field']){
                            switch ($config['filter']){
                                case "equal":
                                    $config['filter_value'] = $condtion['value'];
                                    break;
                                case "like":
                                    $config['filter_value'] = str_replace("%","",$condtion['value']);
                                    break;
                                case "between":
                                    if($condtion['condition'] ==">="){
                                        $config['filter_from_value'] = $condtion['value'];
                                    }else{
                                        $config['filter_to_value'] = $condtion['value'];
                                    }
                                    break;
                            }
                        }
                    }
                }
            }


        }

        return array(
            'condition' => $condition,
            'configs' => $configs
        );
    }
    public function listingConfigs(){
        return  array(
            array(
                'field' =>'id',
                'name' => 'ID',
                'type' => 'text',
                'filter' =>'equal'
            ),
            array(
                'field' =>'name',
                'name' => 'Tên người dùng',
                'type' => 'text'
            ),
            array(
                'field' =>'email',
                'name' => 'Email',
                'type' => 'text',
                'filter' =>'like'
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
            array(
                'field' =>'created_at',
                'name' => 'Ngày tạo',
                'type' => 'text'
            ),
            array(
                'field' =>'updated_at',
                'name' => 'Ngày cập nhật',
                'type' => 'text'
            ),
            array(
                'field' =>'edit',
                'name' => 'Sửa',
                'type' => 'edit'
            ),
            array(
                'field' =>'delete',
                'name' => 'Xóa',
                'type' => 'delete'
            )
        );
    }
}
