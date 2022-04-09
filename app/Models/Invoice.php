<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Invoice extends Model
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
        return $this -> getConfigs('listing');
    }
    public function editingConfigs(){
        return $this -> getConfigs('editing');
    }
    public function getConfigs($interface){
        $configs = $this -> configs();
        $result = [];
        foreach ($configs as $config){
            if(!empty($config[$interface]) && $config[$interface] == true){
                $result[] =$config;
            }
        }
        return $result;
    }
    public function  getRecord($condition, $orderBy){
        return self::orderby($orderBy['field'],$orderBy['sort'])->where($condition)->paginate(6)->withQueryString();
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
                                    'field'=> 'total',
                                    'condition' => '>=',
                                    'value' => $value['from']
                                ];
                            }
                            if(!empty(@$value['to'])){
                                $condition[] =[
                                    'field'=> 'total',
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

            }
            Cookie::queue(strtolower($modelName).'_filter', json_encode($condition), 24 * 60);
            //Cookie 24hours
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
    public function Configs(){
        return  array(
            array(
                'field' =>'id',
                'name' => 'ID',
                'type' => 'text',
                'filter' =>'equal',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'id_user',
                'name' => 'Id người dùng',
                'type' => 'text',
                'filter' =>'like',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'address',
                'name' => 'Địa chỉ giao',
                'type' => 'text',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'total',
                'name' => 'Tổng tiền',
                'type' => 'number',
                'filter' =>'between',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'quantity',
                'name' => 'Số lượng',
                'type' => 'number',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'note',
                'name' => 'Ghi chú',
                'type' => 'text',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'status',
                'name' => 'Trạng thái',
                'type' => 'text',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'created_at',
                'name' => 'Ngày tạo',
                'type' => 'text',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'updated_at',
                'name' => 'Ngày cập nhật',
                'type' => 'text',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'detail',
                'name' => 'Xem',
                'type' => 'detail',
                'listing' => true,
                'editing' => false
            ),
            array(
                'field' =>'delete',
                'name' => 'Xóa',
                'type' => 'delete',
                'listing' => true,
                'editing' => false
            )
        );
    }


}
