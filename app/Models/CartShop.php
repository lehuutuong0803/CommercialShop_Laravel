<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartShop extends Model
{
    use HasFactory;
    public $products = null;
    public $totalPrice = 0;
    public $totalQuanty = 0;

    public function __construct($cart)
    {
       if($cart){
           $this->products = $cart->products;
           $this->totalPrice = $cart->totalPrice;
           $this->totalQuanty = $cart->totalQuanty;
       }
    }

    public function AddCart($product, $id){
        $newProduct = ['quanty' =>0,'price'=>0 ,'productInfo'=>$product];
        if($this->products){
            if(array_key_exists($id, $this->products)){
                $newProduct = $this->products[$id];
            }
        }
        $newProduct['quanty']++;
        $newProduct['price'] = $newProduct['quanty'] * $product['sale_price'];

        $this->products[$id] = $newProduct;
        $this->totalPrice += $product['sale_price'];
        $this->totalQuanty ++;
    }
    public function DeleteCart($id){
        $this->totalQuanty -=$this->products[$id]['quanty'];
        $this->totalPrice -=$this->products[$id]['price'];
        unset($this->products[$id]);
    }
    public function UpdateCart($id,$quanty){
        $this->totalQuanty -= $this->products[$id]['quanty'];
        $this->totalPrice -= $this->products[$id]['price'];

        $this->products[$id]['quanty'] = $quanty;
        $this->products[$id]['price'] = $quanty * $this->products[$id]['productInfo']->sale_price;

        $this->totalQuanty += $this->products[$id]['quanty'];
        $this->totalPrice += $this->products[$id]['price'];



    }
}
