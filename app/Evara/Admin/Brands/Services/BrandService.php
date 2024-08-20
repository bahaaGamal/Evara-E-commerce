<?php

namespace Evara\Admin\Brands\Services;

use File;
use Evara\Admin\Categories\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Evara\Admin\Brands\Models\Brand;
use Evara\Admin\Brands\Requests\CreateBrand;
use Evara\Admin\Brands\Requests\UpdateBrand;
use Evara\Admin\Brands\Repositories\BrandRepository;

class BrandService
{
    private BrandRepository $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

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
        return View('admin.brands.index', compact('brands','categories', 'selectedCategory','searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return View('admin.brands.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBrand $request)
    {
        $data = $request->only(['name','category_id']);
        $data['image'] = $request->file('image')->store('public');

        $this->brandRepository->create($data);

        return to_route('admin.brands.index');
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
        $categories = Category::all();
        return view ('admin.brands.edit', compact('brand','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrand $request, Brand $brand)
    {
        $data = $request->only(['name','category_id']);

        if ($request->hasFile('image')) {
            $new_image = $request->file('image')->store('public');
            File::delete($admin->image);
            $data['image'] = $new_image;
        }

        $this->brandRepository->update($brand,$data);
        return to_route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $this->brandRepository->destroy($brand);
        return redirect()->route('admin.brands.index')->with('success', 'Admin deleted successfully');
    }
}

