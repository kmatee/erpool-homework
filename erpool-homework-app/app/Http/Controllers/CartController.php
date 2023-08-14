<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if (!auth()->check()) {
            session()->flash('flash.banner','You have to login or register to add items to your cart');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->route('home');
        }
        else {
            $form = [
                'id' => $request->input('product_id'),
                'name' => $request->input('product_name'),
                'price' => $request->input('product_price')
            ];
            session()->flash('flash.banner','Item added to your cart');
            session()->flash('flash.bannerStyle', 'success');
            return redirect()->route('home');

            
            //dd($form);

        }

        
    }
}
