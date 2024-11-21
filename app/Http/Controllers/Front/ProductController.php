<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        // return view('front.products.index');
    }
    public function show(Product $product)
    {
        if ($product->status != "active") {
            abort(404);
        }
        return view('front.products.details', compact('product'));
    }
    public function showgrids()
    {
        dd("showgrids");
        $products = Product::active()->take(8)->get();
        return view('front.products.grids', compact('products'));
    }
}
