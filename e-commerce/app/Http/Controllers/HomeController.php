<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->take(8)->get();

        $categories = ProductCategory::all();

        return view('home', compact('products', 'categories'));
    }
}
