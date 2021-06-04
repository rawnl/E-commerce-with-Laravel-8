<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function index(){
        $products = Product::all();
        return view('product', ['products'=>$products]);
    }

    function detail($id){
        $product = Product::find($id);
        return view('detail', ['product'=>$product]);
    }

    function search(Request $request){
        $result = Product::where('name', 'like', '%'.$request->input('query').'%')->get();
        return view('search', ['result'=>$result]);
    }

    function addToCart(Request $request){
        if($request->session()->has('user')){
            $cart = new Cart();
            $cart->user_id=$request->session()->get('user')['id'];
            $cart->product_id=$request->product_id;
            $cart->quantity=1;
            $cart->total=Product::find($request->product_id)['price'];
            $cart->save();
            return redirect(route('home'));
        }else{
            return redirect(route('login'));
        }
    }

    static function cartItems(){
        $userId = Session::get('user')['id'];
        return Cart::where('user_id', $userId)->count();
    }

    function cart(){
        $userId = Session::get('user')['id'];
        $products = DB::table('carts')
                    ->join('products', 'carts.product_id', '=', 'products.id')
                    ->where('carts.user_id', $userId)
                    ->select('products.*')
                    ->get();
        return view('cart', ['products'=>$products]);
    }
}
