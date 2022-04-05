<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Detailed_invoice;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    //Home
    public function index(Request $request){
        $productList =   Product::paginate(4);
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $user = Auth::guard('web')->user();

        return view('clients.home', [
            'productList' =>$productList,
            'user' => $user,
            'cart' => $oldCart

        ]);
    }

    //About
    public function about(){
        $user = Auth::guard('web')->user();
        $oldCart = Session('Cart') ? Session('Cart') : null;
        return view('clients.about', [
            'user' => $user,
            'cart' => $oldCart
        ]);
    }

    //Product
    public function gallery(Request $request){
        $user = Auth::guard('web')->user();
        $product = new \App\Models\Product;
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $configs =$product->listingConfigs();


        $filter_result = $product->getFilter($request, $configs,'Product');
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

        if(!empty($request ->input('cate'))){
            $records= Product::where('id_category',$request -> input('cate'))->paginate(6)->withQueryString();
        }else{
            $records = $product->getRecord($filter_result['condition'],$orderBy);
        }


        $cates = Category::all();
        $oldCart = Session('Cart') ? Session('Cart') : null;
        return view('clients.gallery', [
            'user' => $user,
            'records' => $records,
            'cateList' => $cates,
            'cart' => $oldCart
        ]);
    }

    //Product Details
    public function gallery_details(Request $request, $id){

        $user = Auth::guard('web')->user();
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $product = Product::find($id);
        $relativeProduct = Product::where('id_category',$product['id_category'])->get();
        $comments = Comment::where('id_product',$id)->get();

        return view('clients.gallery_details', [
            'user' => $user,
            'product' => $product,
            'relativeProduct' =>$relativeProduct,
            'cart' => $oldCart,
            'comments'=> $comments
        ]);
    }
    public function payment_history(Request $request){

        $user = Auth::guard('web')->user();
        $invoice = Invoice::where('id_user',$user['id'])->get();
        $cart = Session('Cart') ? Session('Cart') : null;


        return view('clients.payment_history', [
            'user' => $user,
            'invoice' => $invoice,
            'cart' => $cart
        ]);
    }

    public function detailed_payment(Request $request,$id){
        $user = Auth::guard('web')->user();
        $details = Detailed_invoice::where('id_invoice',$id)->get();
        $productList = Product::all();
        $cart = Session('Cart') ? Session('Cart') : null;

        return view('clients.detailed_invoice', [
            'user' => $user,
            'details' => $details,
            'productList' => $productList,
            'id_invoice' => $id,
            'cart' => $cart
        ]);
    }

    public function profile(){
        $user = Auth::guard('web')->user();
        $cart = Session('Cart') ? Session('Cart') : null;

        return view('clients.profile', [
            'user' => $user,
            'cart' => $cart
        ]);
    }
    public function editing_profile(){
        $user = Auth::guard('web')->user();
        $cart = Session('Cart') ? Session('Cart') : null;

        return view('clients.editing_profile', [
            'user' => $user,
            'cart' => $cart
        ]);
    }
    public function editing_profile_active(Request $request,$id){
        $user = Auth::guard('web')->user();
        $cart = Session('Cart') ? Session('Cart') : null;
        $newUser = User::find($user['id']);


        $newUser->name = $request->input('name');
        $newUser->address = $request->input('address');
        $newUser->email = $request->input('email');
        $newUser->number_phone = $request->input('number_phone');

        $newUser -> save();
        return view('clients.editing_profile', [
            'user' => $user,
            'cart' => $cart
        ]);
    }

    public function comment(Request $request,$id){
        $user = Auth::guard('web')->user();


        $comment = new \App\Models\Comment;
        $comment->content = $request->input('comment');
        $comment->id_user = $user['id'];
        $comment->status = 0;
        $comment->id_product = $id;

        $comment->save();

        return redirect('/chi-tiet-san-pham/'.$id);
    }
}
