<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Evara\Admin\Brands\Models\Brand;
use Evara\Admin\Brands\Requests\CreateBrand;
use Evara\Admin\Brands\Requests\UpdateBrand;
use Evara\Admin\Brands\Services\BrandService;

class BrandController extends Controller
{
    private BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->brandService->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->brandService->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBrand $request)
    {
        return $this->brandService->store($request);
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
        return $this->brandService->edit($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrand $request, Brand $brand)
    {
        return $this->brandService->update($request,$brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        return $this->brandService->destroy($brand);
    }
}
