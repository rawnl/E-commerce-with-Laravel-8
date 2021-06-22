<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use Session;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use App\Models\Subscription;
use App\Mail\SubscriptionMail;


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
                $total = $cart->total->sale_price + $product_price;

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
        return view('ordernow', ['total'=>$total, 'source'=>'cart']);
    }

    function confirmOrder(Request $request){
        $userId = Session::get('user')['id'];
        $carts = Cart::where('user_id', $userId)->get();

        if($request->payment_method === 'en-ligne'){
            return view('stripe',['request' => $request] );
        }else{
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
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('orders.*', 
                            'users.nom', 'users.prenom', 'users.email', 
                            'products.name', 'products.price', 'products.description', 'products.category_id', 'categories.name as category_name')
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
        
     
        if($request->input('updateQuantity') > 0){
            if($product->stock_status === 'outofstock'){
                $product->stock_status = 'instock';
            
                $subscriptions =  DB::table('subscriptions')
                                    ->where('product_id', '=', $product->id )
                                    ->where('status', '=', 'NotNotified')
                                    ->join('users', 'subscriptions.user_id', '=', 'users.id')
                                    ->join('products', 'subscriptions.product_id', '=', 'products.id')
                                    ->select('subscriptions.id as subscription_id','users.nom', 'users.prenom', 'users.email', 
                                            'products.name as product_name', 'products.sale_price', 
                                            'products.description', 'products.category_id',
                                            'products.image')
                                    ->get();
    
                ProductController::notifySubscribers($subscriptions);    
            }
        }else{
            $product->stock_status = 'outofstock';
        } 
        
        $product->quantity = $request->input('updateQuantity');

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

    function subscribeToWaitingList(Request $request){
        
        $userId = Session::get('user')['id'];
        $subscription = new Subscription();
        $subscription->user_id = $userId;
        $subscription->product_id = $request->input('product_id');
        $subscription->save();
       
        return redirect()->back();
    }

    public static function notifySubscribers($subscriptions){
        foreach($subscriptions as $subscription){
        
            $data = [
                'nom' => $subscription->nom,
                'prenom' => $subscription->prenom,
                'email' => $subscription->email,
                'product_name' => $subscription->product_name,
                'product_price' => $subscription->sale_price,
                'product_description' => $subscription->description,
                'product_image'=> $subscription->image
            ];

            Mail::to($subscription->email)->send(new SubscriptionMail($data));

            $item = Subscription::find($subscription->subscription_id);
            $item->status = "Notified";
            $item->save();

        }
                    
    }

    function setup(){
        if(Session::has('user')){
            $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.*', 'categories.name as category_name')
                    ->get();
            return view('setup', ['setup_products'=>$products]);
        }else{
            return redirect(route('login'));
        }
    }

    public function setupPost(Request $request)
    {
        $userId = Session::get('user')['id'];
        
        $monitor = Product::find($request->selected_monitor);
        $computer_case = Product::find($request->selected_computer_case);
        $mother_board = Product::find($request->selected_mother_board);
        $cpu = Product::find($request->selected_cpu);
        $graphic_card = Product::find($request->selected_graphic_card);
        $ram = Product::find($request->selected_ram);
        $power_supply = Product::find($request->selected_power_supply);
        $hard_drive = Product::find($request->selected_hard_drive);
        $fan = Product::find($request->selected_fan);

        $cart = new Cart();
        
        $total =$monitor->sale_price + $computer_case->sale_price + $mother_board->sale_price +
                   $cpu->sale_price + $graphic_card->sale_price + $ram->sale_price + 
                   $power_supply->sale_price + $hard_drive->sale_price + $fan->sale_price ;
        
        $products = [
          'monitor' => $monitor,
          'computer_case' => $computer_case,
          'mother_board' => $mother_board,
          'cpu' => $cpu,
          'graphic_card' => $graphic_card,
          'ram' => $ram,
          'power_supply' => $power_supply,
          'hard_drive' => $hard_drive,
          'fan' => $fan
        ];
        
                 
        foreach($products as $product){
            $cart = DB::table('carts')
                        ->where('user_id', $request->session()->get('user')['id'] )
                        ->where('product_id', $request->product_id )
                        ->first();
                        
            if(!is_null($cart)){
                Cart::destroy($cart->id);
            }
            $cart = new Cart();
            $cart->user_id = $request->session()->get('user')['id'] ;
            $cart->product_id = $product->id; 
            $cart->quantity=1;
            $cart->total = $product->sale_price;
            $cart->save();
        }

        return view('ordernow', ['total'=>$total, 'products'=>$products, 'source'=>'setup']);  
        
    }

    public static function addElementToCart($cart, $product, $user_id){

        $cart->user_id = $user_id;
        $cart->product_id = $request->product_id; 
        $cart->quantity=1;
        $cart->total = $product_price;
        $cart->save();
    
    }
}
