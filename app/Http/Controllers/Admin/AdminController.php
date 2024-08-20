<?php

namespace App\Http\Controllers\Admin;

use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Evara\Admin\Admins\Models\Admin;
use Evara\Admin\Admins\Requests\CreateAdmin;
use Evara\Admin\Admins\Requests\UpdateAdmin;
use Evara\Admin\Admins\Services\AdminService;

class AdminController extends Controller
{

    private AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       return $this->adminService->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->adminService->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdmin $request)
    {
        return $this->adminService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return $this->adminService->edit($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdmin $request, Admin $admin)
    {
        return $this->adminService->update($request, $admin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        return $this->adminService->destroy($admin);
    }
}
