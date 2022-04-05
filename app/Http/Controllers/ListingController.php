<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function index(Request $request,$modelName){

        $model = '\App\Models\\'.$modelName;
        $model = new $model;
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

        $admin = Auth::guard('admin')->user();
        return view('admin.listing', [
                            'user' =>$admin,
                            'records' => $records,
                            'namePage'=> $name,
                            'configs' => $configs,
                            'modelName' =>$modelName,
                            'orderBy' => $orderBy
        ]);
    }
}
