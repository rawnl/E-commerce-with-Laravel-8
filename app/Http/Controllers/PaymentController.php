<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Session;

use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;

class PaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }
   
    public function stripePost(Request $request)
    {
        $userId = Session::get('user')->id;
        $amount = (int) $request->total;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $amount, 
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose"
        ]);
        $carts = Cart::where('user_id', $userId)->get();
        foreach($carts as $cart){
            $order = new Order;
            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->status='en attente';
            $order->payment_method = $request->payment_method; 
            $order->payment_status = 'validé';
            $order->address = $request->address; 
            $order->save();
            Cart::where('user_id', $userId)->delete();
        }

        Session::flash('success', 'Payment successful!');
        
        return redirect(route('home'));   
        
    }
}
