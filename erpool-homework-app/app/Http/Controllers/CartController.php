<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CartController extends Controller
{

    public function index()
    {
        $user_id = auth()->user()->id;
        \Cart::session($user_id);
        $items = \Cart::getContent();
        return Inertia::render('ShoppingCart', [
            'items' => $items,
        ]);
    }

    public function addToCart(Request $request)
    {
        if (!auth()->check()) {
            session()->flash('flash.banner','You have to login or register to add items to your cart');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->route('home');
        }
        else {
            $user_id = auth()->user()->id;
            $product = Product::find($request->input('product_id'));

            \Cart::session($user_id)->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => array('image' => $product->image_url),
            ));
            
            session()->flash('flash.banner','Item added to your cart');
            session()->flash('flash.bannerStyle', 'success');
            
            return redirect()->route('home');
            
            //dd($form);

        }

        
    }
}
