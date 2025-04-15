<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\HasApiTokens;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::filter($request->query())->with([
            'category:id,name',
            'store:id,name',
            'tags:id,name'
        ])->paginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            "category_id" => "required|exists:categories,id",
            "status" => "nullable|boolean|in:active,inactive",
            "price" => "required|numeric|min:0",
            "compare_price" => "nullable|numeric|gte:price",
            "store_id" => "required|exists:stores,id",
            // "options"=>"nullable|string",
            // "rating"=>"nullable|numeric",
            // "featured"=>"nullable|boolean",
            // "tags"=>"nullable|array",
            // "tags.*"=>"exists:tags,id"
        ]);
        $user = $request->user();
        if($user->tokenCan('products.create')){
            return Product::create($request->all());
        }
        return Response::json([
            'message' => 'Unauthorized'
        ], 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
        // return $product->load([
        //     'category:id,name',
        //     'store:id,name',
        //     'tags:id,name'
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:255',
            "category_id" => "sometimes|required|exists:categories,id",
            "status" => "nullable|boolean|in:active,inactive",
            "price" => "sometimes|required|numeric|min:0",
            "compare_price" => "nullable|numeric|gte:price",
            "store_id" => "sometimes|required|exists:stores,id",
            // "options"=>"nullable|string",
            // "rating"=>"nullable|numeric",
            // "featured"=>"nullable|boolean",
            // "tags"=>"nullable|array",
            // "tags.*"=>"exists:tags,id"
        ]);
        $user = $request->user();
        if($user->tokenCan('products.update')){
            $product->update($request->all());
            return Response::json($product);
        }
        return Response::json([
            'message' => 'Unauthorized'
        ], 401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::guard('sanctum')->user();
        if($user->tokenCan('products.delete')){
            Product::destroy($id);
            return response()->json([
                'message' => 'Product deleted successfully'
            ], 200);
        }
        return Response::json([
            'message' => 'Unauthorized'
        ], 401);
    }
}
