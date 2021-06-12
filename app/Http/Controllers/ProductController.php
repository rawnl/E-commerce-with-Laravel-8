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
        
            $product_price = Product::find($request->product_id)['price'];
            
            if(Product::find($request->product_id)['sale_price'] != null){
                $product_price = Product::find($request->product_id)['sale_price'];
            }

            $cart = DB::table('carts')
                        ->where('user_id', $request->session()->get('user')['id'] )
                        ->where('product_id', $request->product_id )
                        ->first();

            if(!is_null($cart)){
                $total = $cart->total + $product_price;
  /*          
                if(Product::find($request->product_id)['sale-price'] != null){
                    $total = $cart->total + Product::find($request->product_id)['sale-price'];
                }
*/
                $Qt = $cart->quantity + 1;
                $cart = DB::table('carts')
                                ->where('user_id', $request->session()->get('user')['id'] )
                                ->where('product_id', $request->product_id )
                                ->update(['quantity' => $Qt, 'total' => $total]);
            }else{
                $cart = new Cart();
                $cart->user_id = $request->session()->get('user')['id'];
                $cart->product_id = $request->product_id; 
                $cart->quantity=1;
                $cart->total = $product_price;
                $cart->save();
            }
            return redirect(route('home'));
        }else{
            return redirect(route('login'));
        }
    }
    function increaseQty($cart_id){
        $cart = Cart::find($cart_id);     
        $product = Product::find($cart->product_id);

        if($product->stock_status == "instock" && $product->quantity > 0){

            $Qt = $cart->quantity + 1;
            $old_total = $cart->total;
            
            $product_price = Product::find($cart->product_id)['price'];
            
            if(Product::find($cart->product_id)['sale_price'] != null){
                $product_price = Product::find($cart->product_id)['sale_price'];
            }

            $total = $old_total + $product_price ;

            $cart->quantity = $Qt;
            $cart->total = $total;
            $cart->save();

            return redirect(route('cart'));
                
        }else{
            //send msg no element left
            //removeFromCart($cart_id);
        }

    }

    function decreaseQty($cart_id){        
        $cart = Cart::find($cart_id);

        if($cart->quantity > 1){
            $Qt = $cart->quantity - 1;
            $old_total = $cart->total;
            $product_price = Product::find($cart->product_id)['price'];
            
            if(Product::find($cart->product_id)['sale_price'] != null){
                $product_price = Product::find($cart->product_id)['sale_price'];
            }

            $total = $old_total - $product_price ;
            
            $cart->quantity = $Qt;
            $cart->total = $total;
            $cart->save();

            return redirect(route('cart'));
            
        }else{
            Cart::destroy($cart_id);
            return redirect(route('cart'));
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
                    ->select('products.*', 'carts.id as cart_id', 'carts.quantity as quantity', 'carts.total as total')
                    ->get();
        return view('cart', ['products'=>$products]);
    }

    function removeFromCart($id){
        Cart::destroy($id);
        return redirect()->route('cart');
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

    function dashboard(){
        $userId = Session::get('user')['id'];
        $pending_orders = DB::table('orders')
                    ->join('products', 'orders.product_id', '=', 'products.id')
                    ->where('orders.status', 'en attente')
                    ->select('orders.*','products.name')
                    ->get();
        return view('dashboard', ['pending_orders'=>$pending_orders]);
    }

    function products(){
        $products = Product::all();
        return view('productCrud', ['products'=>$products]);
    }

    function orders(){
        $orders = DB::table('orders')
                    ->join('products', 'orders.product_id', '=', 'products.id')
                    ->join('users', 'orders.user_id', '=', 'users.id')
                    ->select('orders.*', 
                            'users.nom', 'users.prenom', 'users.email', 
                            'products.name', 'products.price', 'products.description', 'products.category')
                    ->get();
        return view('orders', ['orders'=>$orders]);
    }

    function changeOrderStatus(Request $request){
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

    function cancelOrder($id){
        
        $order = Order::find($id);
        $order->status ='annulee';
        $order->payment_status = 'annulee';
        $order->save();
        
        return redirect(route('dashboard'));//, ['pending_orders'=>$pending_orders]);
    }

    function validateOrder($id){
        DB::table('orders')->where('id',$id)
                            ->update(['status' => 'confirmee','payment_status' => 'confirmee']);

        $pending_orders = DB::table('orders')
                    ->join('products', 'orders.product_id', '=', 'products.id')
                    ->where('orders.status', 'en attente')
                    ->get();
        
        return redirect()->back()->with('pending_orders', $pending_orders);
    }
    
    function deleteProduct($id){
        Product::destroy($id);
        return redirect(route('products'));
    }

    function addProduct(Request $request){

        $product = new Product();
        $product->name= $request->input('name');;
        $product->price = $request->input('price');
        $product->category = $request->input('category');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        
        $imageName = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images',$imageName);
        
        $product->image = $imageName;
        $product->save();

        return redirect()->back();      
    }

    function editProduct(Request $request){
        $product = Product::find($request->input('updateId'));

        $product->name= $request->input('updateName');;
        $product->price = $request->input('updatePrice');
        $product->category_id = (int)$request->input('updateCategory');
        $product->description = $request->input('updateDescription');
        $product->quantity = $request->input('updateQuantity');
     
        if($request->hasFile('updateImage')){
            $imageName = $request->file('updateImage')->getClientOriginalName();
            $request->file('updateImage')->storeAs('public/images',$imageName);
            $product->image = $imageName;
        }
        
        $product->save();
        
        return redirect()->back(); 
    }
}
