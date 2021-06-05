<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
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
                    ->select('products.*', 'carts.id as cart_id')
                    ->get();
        return view('cart', ['products'=>$products]);
    }

    function removeFromCart($id){
        Cart::destroy($id);
        return redirect(route('cart'));
    }

    function orderNow(){
        $userId = Session::get('user')['id'];
        $total = DB::table('carts')
                    ->join('products', 'carts.product_id', '=', 'products.id')
                    ->where('carts.user_id', $userId)
                    ->sum('products.price');
        return view('ordernow', ['total'=>$total]);
    }

    function confirmOrder(Request $request){
        $userId = Session::get('user')['id'];
        $carts = Cart::where('user_id', $userId)->get();
        foreach($carts as $cart){
            $order = new Order;
            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->status='en attente';
            $order->payment_method = $request->payment_method;
            $order->payment_status = 'en attente';
            $order->address = $request->address;
            $order->save();
            Cart::where('user_id', $userId)->delete();
        }
        return redirect(route('home'));
    }

    function myOrders(){
        $userId = Session::get('user')['id'];
        $orders = DB::table('orders')
                    ->join('products', 'orders.product_id', '=', 'products.id')
                    ->where('orders.user_id', $userId)
                    ->get();
        return view('myorders', ['orders'=>$orders]);
    }
}
