<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
class AdminController extends Controller
{
    public function loginPost(Request $request){
            $credentials = $request->only('email', 'password');

            if(Auth::guard('admin')->attempt($credentials)){

                return redirect('quan-tri/trang-chu');
            }else{
                return view('admin.login',['login' =>'Tài khoản mật khẩu không đúng !']);
            }
    }

    public function home(){

            $admin = Auth::guard('admin')->user();
            $products = Product::all();
            $users = User::all();
            $invoices = Invoice::all();

            $totalProduct = count($products);
            $totalUser = count($users);
            $totalInvoice = count($invoices);

            $totalPrice =0;
            foreach ($invoices as $item){
                $totalPrice +=  $item['total'];
             }


            return view('admin.home', [
                'user' =>$admin,
                'totalProduct' => $totalProduct,
                'totalUser' => $totalUser,
                'totalInvoice' => $totalInvoice,
                'totalPrice' => $totalPrice
            ]);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('quan-tri/dang-nhap');
    }

    public function statistic(){
        echo "Thong ke";
    }
}
