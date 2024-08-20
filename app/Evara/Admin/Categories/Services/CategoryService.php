<?php

namespace Evara\Admin\Categories\Services;

use File;
use Illuminate\Http\Request;
use Evara\Admin\Categories\Models\Category;
use Evara\Admin\Categories\Requests\CategoryRequest;
use Evara\Admin\Categories\Repositories\CategoryRepository;


class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->get('search');

        $categories = Category::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', "%{$searchTerm}%");
        })->get();

        return View('admin.categories.index', compact('categories','searchTerm'));
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
    public function store(CategoryRequest $request)
    {
       $this->categoryRepository->create($request->validated());

        return to_route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return View('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return View('admin.categories.edit', compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryRepository->update($category, $request->validated());

        return to_route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->categoryRepository->destroy($category);

        return to_route('admin.categories.index');
    }

}

