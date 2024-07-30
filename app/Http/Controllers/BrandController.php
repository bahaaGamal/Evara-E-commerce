<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = $request->get('category_id');
        $searchTerm = $request->get('search');

        $brands = Brand::when($selectedCategory, function ($query, $selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', "%{$searchTerm}%");
        });

        $brands = $brands->get();
        return View('brands.index', compact('brands','categories', 'selectedCategory','searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return View('brands.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string|min:3|max:255',
            'category' => 'required|integer|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $image = request()->file('image')->store('public');

        $brand = new Brand;

        $brand->name = $request->name;
        $brand->category_id = $request->category;
        $brand->image = $image;

        $brand->save();

        return to_route('brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
