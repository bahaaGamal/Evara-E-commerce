<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Evara\Admin\Categories\Models\Category;
use Evara\Admin\Categories\Requests\CategoryRequest;
use Evara\Admin\Categories\Services\CategoryService;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->categoryService->index($request);

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
        return $this->categoryService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->categoryService->show($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return $this->categoryService->edit($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        return $this->categoryService->update($request,$category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        return $this->categoryService->destroy($category);
    }
}
