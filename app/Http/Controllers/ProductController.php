<?php

namespace App\Http\Controllers;

use File;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function index()

    public function index(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = $request->get('category_id');
        $sortBy = $request->get('sort_by');
        $searchTerm = $request->get('search');

        $products = Product::when($selectedCategory, function ($query, $selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('title', 'like', "%{$searchTerm}%");
        });

        switch ($sortBy) {
            case 'cheap_first':
                $products->orderBy('price', 'asc');
                break;
            case 'most_viewed':
                $products->orderBy('views', 'desc');
                break;
            case 'latest_added':
            default:
                $products->orderBy('created_at', 'desc');
                break;
        }

        $products = $products->paginate(10);

        return view('products.index', compact('products', 'categories', 'selectedCategory', 'sortBy', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return View('products.create',compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'brand' => 'required|integer',
            'price' => 'required|numeric',
            'category' => 'required|integer|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $image = request()->file('image')->store('public');


        $product = new Product([
            'title' => $request->title,
            'description' => $request->description,
            'brand_id' => $request->brand,
            'price' => $request->price,
            'category_id' => $request->category,
            'image' => $image,
        ]);

        $product->save();

        return response()->json(['status' => 'success','message' => 'Data Added Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->views += 1;
        $product->save();

        return View('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return View('products.edit',compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $old_image = $product->image;
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'brand' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|integer|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->category_id = $request->category;

        if(request()->hasFile('image')){
            $new_image = request()->file('image')->store('public');
            File::delete($old_image);
            $product->image = $new_image;
        }

        $product->save();

        return response()->json(['status' => 'success','message' => 'Data Updated Successfully']);    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['status' => 'success','message' => 'Data Deleted Successfully']);
    }
}
