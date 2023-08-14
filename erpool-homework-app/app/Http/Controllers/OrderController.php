<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{


    public function orderConfirm(Request $request)
    {
        $items = $request->input('items');
        $total = 0;
        foreach ($items as $item) {
            
            if ($item['quantity'] >= 3 && $item['quantity'] < 5){
                $total += (($item['price']* $item['quantity']) * 0.9);
            }
            else if ($item['quantity'] >= 5){
                $total += (($item['price'] * $item['quantity']) * 0.85);
            }
            else {
                $total += ($item['price'] * $item['quantity']);
            }
        }


        return Inertia::render('OrderConfirm', [
            'final_items' => $request->input('items'),
            'final_total' => $total,
        ]);
    }

    public function thankYou()
    {
        return Inertia::render('ThankYou');
    }
}
