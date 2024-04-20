<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $totalPrice = 0;

        foreach($products as $product){
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        // dd($products, $totalPrice);

        return view('user.cart',
        compact('products', 'totalPrice'));
    }

    public function add(Request $request)
    {
        $itemInCart = Cart::where('product_id', $request->product_id)
        ->where('user_id', Auth::id())->first();

        if($itemInCart){
            $itemInCart->quantity += $request->quantity;
            $itemInCart->save();
            
        } else{
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }
        return redirect()->route('user.cart.index');
    }

    public function delete($id)
    {
        Cart::where('product_id', $id)
        ->where('user_id', Auth::id())
        ->delete();

        return redirect()->route('user.cart.index');
    }

    public function checkout()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        $LineItems = [];

        foreach($products as $product){
            $LineItem = [
                'name' => $product->name,
                'description' => $product->information,
                'amount' => $product->price,
                'cueency' => 'jpy',
                'quantity' => $product->pivot->quantity
            ];

            
            array_push($LineItems, $LineItem);
           
        }
        // dd($LineItems);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY '));
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$LineItems],
            'mode' => 'payment',
            'success_url' => route('user.items.index') . '/success.html',
            'cancel_url' => route('user.cart.index') . '/cancel.html',
        ]);

        $publicKey = env('STRIPE_PUBLIC_KEY ');

        return view('user.checkout',
        compact('session', 'publicKey'));

    }
}
