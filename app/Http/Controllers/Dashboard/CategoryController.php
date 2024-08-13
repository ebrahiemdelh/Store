<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::with('parent')
        ->withCount([
            'products' => function($query) {
                $query->where('status', 'active');
            }
            ]) //has error in counting products
        // ->select('categories.*') // at more than one selection we use [] or use addSelect()
        // ->selectRaw('(SELECT COUNT(*) FROM PRODUCTS WHERE status = "active" AND category_id = categories.id) as products_count')// selectRaw can be used more than one time
        // select(DB::raw('(SELECT COUNT(*) FROM PRODUCTS WHERE category_id = categories.id) as products_count'))->
            /*leftJoin('categories as parent', 'parent.id', '=', 'categories.parent_id')->select(['categories.*','parent.name as parent_name'])->*/
            ->filter($request->query())
            ->paginate();
        // $categories = Category::simplePaginate(); use this for simple pagination without numbers for pages
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        return view('dashboard.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string| unique:categories| not_in:admin,administrator',
            'parent_id' => 'int| exists:categories,id',
            'image' => 'mimes:png,jpg,jpeg| max:1048576| ', //dimensions:max_width=100,max_height=200',
            'status' => 'in:active,archived',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $request->file('image')->getClientOriginalName();
            $path = $file->storeAs('Categories/' . $request->name, $name, public_path('uploads'));
            $request['image'] = $path;
        }
        // dd($request['image']);
        $request->merge(['slug' => Str::slug($request->post('name'))]);
        $category = Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if ($category == null) return redirect()->route('categories.index')->with('info', 'Record not Found');
        $parents = Category::where('id', '<>', $id)->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $oldImage = $category->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $request->file('image')->getClientOriginalName();
            $path = $file->storeAs('uploads', $name, 'public');
        }
        $request['image'] = $path;
        $category->update($request->all());
        if ($oldImage && isset($request['image'])) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::destroy($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.index', compact('categories'));
    }
    public function restore($id)
    {
        $categories = Category::where('id', $id)->restore();
        return redirect()->route('categories.trash')->with('success', 'Category restored successfully');
    }
    public function forceDelete($id)
    {
        $categories = Category::where('id', $id)->forceDelete();
        return redirect()->route('categories.trash')->with('danger', 'Category Deleted Successfully');
    }
}
