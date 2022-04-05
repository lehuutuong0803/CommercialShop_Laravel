<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Base extends Model
{
    use HasFactory;
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
    public function defaultListingConfigs(){
        return  array(
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
                'field' =>'edit',
                'name' => 'Sửa',
                'type' => 'edit',
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
