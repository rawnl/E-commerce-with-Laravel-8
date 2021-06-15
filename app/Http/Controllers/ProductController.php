<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    function index(){
        $products = Product::all();
        return view('product', ['products'=>$products]);
    }

    function detail($id){
        $product = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->where('products.id', $id)
                    ->select('products.*', 'categories.name as category_name')
                    ->get();

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

            return redirect(route('cart'))->with('success','Quantité décrémentée');

        }else{
            Cart::destroy($cart_id);
            return redirect(route('cart'))->with('error','Article supprimé du panier');;
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
                    ->select('products.*', 'carts.id as cart_id', 'carts.quantity as cart_quantity', 'carts.total as total')
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
        $categories = Category::all();
        return view('productCrud', ['products'=>$products, 'categories' => $categories]);
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
        $product->name = $request->input('name');
        $product->slug = Str::slug($product->name);
        $product->SKU = $product->name;
        $product->price = $request->input('price');
        
        if($request->input('sale_price') == null){
            $product->sale_price = $request->input('price');
        }else{
            $product->sale_price = $request->input('sale_price');
        }
       
        $product->category_id = (int)$request->input('category');
        $product->description = $request->input('description');
        $product->short_description = $request->input('shortDescription');
        $product->quantity = $request->input('quantity');
        
        if($product->quantity > 0){
            $product->stock_status = 'instock';
        }else{
            $product->stock_status = 'outofstock';
        }    

        $imageName = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images',$imageName);
        
        $product->image = $imageName;
        $product->save();

        return redirect()->back();      
    }

    function editProduct(Request $request){
        $product = Product::find($request->input('updateId'));

        $product->name= $request->input('updateName');
        $product->price = $request->input('updatePrice');

        if($request->input('updateSalePrice') == null){
            $product->sale_price = $request->input('updatePrice');
        }else{
            $product->sale_price = $request->input('updateSalePrice');
        }

        $product->category_id = (int)$request->input('updateCategory');
        $product->short_description = $request->input('updateShortDescription');
        $product->description = $request->input('updateDescription');
        $product->quantity = $request->input('updateQuantity');
     
        if($product->quantity > 0){
            $product->stock_status = 'instock';
        }else{
            $product->stock_status = 'outofstock';
        } 

        if($request->hasFile('updateImage')){
            $imageName = $request->file('updateImage')->getClientOriginalName();
            $request->file('updateImage')->storeAs('public/images',$imageName);
            $product->image = $imageName;
        }
        
        $product->save();
        
        return redirect()->back(); 
    }

    function addCategory(Request $request){
        //$category = Category::where('name', $request->category)->get();
        $category = new Category();
        $category->name =  $request->category ;
        $category->slug =  Str::slug($request->category) ;
        $category->save();
        
        return redirect()->back(); 
    }
}
