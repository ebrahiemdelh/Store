<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);
        $products = Product::filter($request->query())->with(['category', 'store'])->paginate(10);
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Product::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('view', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);
        $categories = Category::all();
        // $stores = Auth::user()->stores;
        $tags = implode(",", $product->tags->pluck('name')->toArray());
        $stores = Store::all();
        return view('dashboard.products.edit', compact('product', 'categories', 'stores', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)

    {
        $this->authorize('update', $product);
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'status' => 'required|in:active,draft,archived',
            'options' => 'nullable|array',
            'image' => 'image',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
        ]);
        $product->update($request->except('tags'));


        $tags=json_decode($request->post('tags'));
        $tag_ids = [];


        $saved_tags=Tag::all();


        foreach ($tags as $tag) {
            // dd($tag->value);
            $slug = Str::slug($tag->value);
            $tag_model = $saved_tags->where('slug', $slug)->first();
            if (!$tag_model) {
                $tag_model = Tag::create([
                    'name' => $tag->value,
                    'slug' => $slug
                ]);
            }
            $tag_ids[] = $tag_model->id;
        }
        $product->tags()->sync($tag_ids);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
