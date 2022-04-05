<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditingController extends Controller
{
    public function create(Request $request,$modelName){
        $model = '\App\Models\\'.$modelName;
        $model = new $model;
        $configs =$model-> editingConfigs();
        $admin = Auth::guard('admin')->user();
        $cates =[];
        if($modelName == "Product"){
            $categoryModel = new \App\Models\Category;
            $configsCate =$categoryModel ->listingConfigs();
            $filter_cate = $categoryModel->getFilter($request, $configsCate,'Category');
            $orderByIDCate =[
                'field'=>'id',
                'sort' =>'asc'
            ];
            $cates = $categoryModel->getRecord($filter_cate['condition'],$orderByIDCate);
        }

        return view('admin.editing', [
            'user' =>$admin,
            'configs' => $configs,
            'modelName' => $modelName,
            'cates' => $cates
        ]);
    }

    public function store (Request $request,$modelName){
        $admin = Auth::guard('admin')->user();
        $model = '\App\Models\\'.$modelName;
        $model = new $model;
        $configs =$model-> editingConfigs();
        $arrayValidatefields =[];

        foreach ($configs as $config){
            if(!empty($config['validate'])){
                $arrayValidatefields[$config['field']] = $config['validate'];
            }
        }
        $validated = $request->validate($arrayValidatefields);
        $data = [];
        foreach ($configs as $config){
            if(!empty($config['editing']) && $config['editing'] == true){
                switch ($config['type']){
                    case "image":
                        if($request->hasFile($config['field'])){
                            $namefile = $request-> file($config['field']) ->getClientOriginalName();
                            $path = $request -> file($config['field'])->storeAs(
                                'public',$namefile
                            );
                            $model->{$config['field']} =  "/".str_replace("public", 'storage',$path);
                        }
                        break;

                    default:
                        $model->{$config['field']} = $request -> input($config['field']);
                        break;
                }
            }
        }


        return view('admin.editing', [
            'success' =>  $model -> save(),
            'user' =>$admin,
            'configs' => $configs,
            'modelName' => $modelName
        ]);
    }

    public function update(Request $request,$modelName,$id){
        $model = '\App\Models\\'.$modelName;
        $model = new $model;
        $configs =$model-> editingConfigs();
        $admin = Auth::guard('admin')->user();

        $item = $model::find($id);


        $cates =[];
        if($modelName == "Product"){
            $categoryModel = new \App\Models\Category;
            $configsCate =$categoryModel ->listingConfigs();
            $filter_cate = $model->getFilter($request, $configsCate,'Category');
            $orderByIDCate =[
                'field'=>'id',
                'sort' =>'asc'
            ];
            $cates = $categoryModel->getRecord($filter_cate['condition'],$orderByIDCate);
        }

        return view('admin.update', [
            'user' =>$admin,
            'configs' => $configs,
            'modelName' => $modelName,
            'cates' => $cates,
            'item' => $item
        ]);
    }
    public function updating(Request $request,$modelName,$id){
        $model = '\App\Models\\'.$modelName;
        $model = new $model;
        $configs =$model-> editingConfigs();
        $admin = Auth::guard('admin')->user();

        $item = $model::find($id);


        foreach ($configs as $config){
            if(!empty($config['editing']) && $config['editing'] == true){
                switch ($config['type']){
                    case "image":
                        if($request->hasFile($config['field'])){
                            $namefile = $request-> file($config['field']) ->getClientOriginalName();
                            $path = $request -> file($config['field'])->storeAs(
                                'public',$namefile
                            );
                            $item->{$config['field']} =  "/".str_replace("public", 'storage',$path);
                        }
                        break;

                    default:
                        $item->{$config['field']} = $request -> input($config['field']);
                        break;
                }
            }
        }
        $item -> save();
        $cates =[];
        if($modelName == "Product"){
            $categoryModel = new \App\Models\Category;
            $configsCate =$categoryModel ->listingConfigs();
            $filter_cate = $model->getFilter($request, $configsCate,'Category');
            $orderByIDCate =[
                'field'=>'id',
                'sort' =>'asc'
            ];
            $cates = $categoryModel->getRecord($filter_cate['condition'],$orderByIDCate);
        }
        return view('admin.update', [
            'user' =>$admin,
            'configs' => $configs,
            'modelName' => $modelName,
            'cates' => $cates,
            'item' => $item,
            'success' => true
        ]);
    }

    public function deleting(Request $request,$modelName,$id){
        $admin = Auth::guard('admin')->user();
        $model = '\App\Models\\'.$modelName;
        $model = new $model;

        $name="";



        switch ($modelName){
            case "User":
                $name = "Quản lý tài khoản";
                break;
            case "Product":
                $name = "Quản lý sản phẩm";

                break;
            case "Category":
                $name = "Quản lý loại sản phẩm";
                break;
            case "Comment":
                $name = "Quản lý bình luận";
                break;
            case "Invoice":
                $name = "Quản lý hóa đơn";
                break;
        }
        $item = $model::find($id);

        $item->delete();
        $configs =$model ->listingConfigs();
        $filter_result = $model->getFilter($request, $configs,$modelName);
        $configs = $filter_result['configs'];
        $orderBy =[
            'field'=>'id',
            'sort' =>'asc'
        ];
        if($request ->input('sort')){
            $field =substr($request -> input('sort'),0, strrpos($request->input('sort'),"_"));
            $sort = substr($request -> input('sort'), strrpos($request->input('sort'),"_") + 1);
            $orderBy =[
                'field'=>$field,
                'sort' =>$sort
            ];
        }
        $records = $model->getRecord($filter_result['condition'],$orderBy);

        return view('admin.listing', [
            'user' =>$admin,
            'records' => $records,
            'namePage'=> $name,
            'configs' => $configs,
            'modelName' =>$modelName,
            'orderBy' => $orderBy,
            'deleting' => true
        ]);
    }
}
