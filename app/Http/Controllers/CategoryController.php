<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->get('search');

        $categories = Category::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', "%{$searchTerm}%");
        });

        $categories = $categories->get();
        return View('categories.index', compact('categories','searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string|min:3|max:255',
            'slug' => 'required|string|unique:categories,slug|max:255',
            'parent' => 'nullable|integer|exists:categories,id',
            'description' => 'required|string',
        ]);

        $category = new Category;

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent = $request->parent;
        $category->description = $request->description;

        $category->save();

        return to_route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return View('categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return View('categories.edit', compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        request()->validate([
            'name' => 'required|string|min:3|max:255',
            'slug' => 'required|string|max:255',
            'parent' => 'nullable|integer|exists:categories,id',
            'description' => 'required|string',
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent = $request->parent;
        $category->description = $request->description;

        $category->save();

        return to_route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('categories.index');
    }
}
