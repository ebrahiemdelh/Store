<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $categories=Category::filter("active")->get();
        $products=Product::with("category")->active()
        // ->latest()
        ->take(8) // or limit(8)
        ->get();
        return view('front.home',compact('products'));
    }
}
