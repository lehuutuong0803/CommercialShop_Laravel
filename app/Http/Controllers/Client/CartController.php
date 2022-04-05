<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartShop;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CartController extends Controller
{
    public function index(){
        $user = Auth::guard('web')->user();
        $cart = Session('Cart') ? Session('Cart') : null;
        return view('clients.cart', [
            'user' => $user,
            'cart' => $cart
        ]);
    }

    public function addcart(Request $request,$id){
        $product  = Product::find($id);
        if($product != null){
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new CartShop($oldCart);
            $newCart->AddCart($product,$id);

            $request ->session()->put('Cart', $newCart);
        }
        $amount = $newCart->totalQuanty;
        return $amount;
    }

    public function deleteitemcart(Request $request,$id){
        $user = Auth::guard('web')->user();
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new CartShop($oldCart);
        $newCart->DeleteCart($id);
        if(Count($newCart ->products) >0){
            $request ->session()->put('Cart', $newCart);
        }else{
            $request ->session()->forget('Cart');
        }
        $cart = Session('Cart') ? Session('Cart') : null;
        return view('clients.cart', [
            'user' => $user,
            'cart' =>$cart
        ]);
    }
    public function updateitemcart(Request $request,$id,$quanty){
        $user = Auth::guard('web')->user();
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new CartShop($oldCart);
        $newCart->UpdateCart($id,$quanty);

        $request ->session()->put('Cart', $newCart);

        return view('clients.cart', [
            'user' => $user,
            'cart' =>$newCart
        ]);
    }
    public function checkout(Request $request){
        $user = Auth::guard('web')->user();
        $cart = Session('Cart') ? Session('Cart') : null;

        $invoice = new \App\Models\Invoice();

        $invoice->id_user = $user['id'];
        $invoice->address = $user['address'];
        $invoice->total = $cart->totalPrice;
        $invoice->quantity = $cart->totalQuanty;
        $invoice->status = 0;
        $invoice->save();
        $id_invoice = $invoice->id;

        foreach ($cart->products as $item){
            $newDetail = new \App\Models\Detailed_invoice();
            $newDetail->id_product = $item['productInfo']->id;
            $newDetail->id_invoice = $id_invoice;
            $newDetail->into_money = $item['price'];
            $newDetail->quantity = $item['quanty'];

            $newDetail->save();
        }


        $request ->session()->forget('Cart');
        return view('clients.success_checkout', [
            'user' => $user
        ]);
    }

}
