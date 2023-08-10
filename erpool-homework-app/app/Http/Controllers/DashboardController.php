<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $users = User::all();

        return Inertia::render('Dashboard', [
            'products' => $products,
            'categories' => $categories,
            'users' => $users,
        ]);
    }
}
