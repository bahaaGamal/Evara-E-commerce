<?php

namespace Evara\Admin\Admins\Services;

use App\Http\Controllers\Controller;
use Evara\Admin\Admins\Models\Admin;
use Evara\Admin\Admins\Repositories\AdminRepository;
use Illuminate\Http\Request;
use File;
use Evara\Admin\Admins\Requests\CreateAdmin;
use Evara\Admin\Admins\Requests\UpdateAdmin;

class AdminService
{
    private AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admins = $this->adminRepository->all();

        $adminType = $request->get('admin_type');
        $searchTerm = $request->get('search');

        $admins = $admins->when($adminType, function ($query, $adminType) {
            return $query->where('status', $adminType);
        })->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', "%{$searchTerm}%");
        });


        return view('admin.admins.index', compact('admins', 'adminType', 'searchTerm'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdmin $request)
    {
        $data = $request->only(['name', 'email', 'phone', 'status']);
        $data['password'] = bcrypt('password');

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('public');
        }

        $this->adminRepository->create($data);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully');
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
        return View('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdmin $request, Admin $admin)
    {
        $data = $request->only(['name', 'email', 'phone', 'status']);
        $data['password'] = $admin->password;

        if ($request->hasFile('image')) {
            $new_image = $request->file('image')->store('public');
            File::delete($admin->image);
            $data['image'] = $new_image;
        }

        $this->adminRepository->update($admin, $data);

        return redirect()->route('admin.admins.edit', compact('admin'))->with('success', 'Admin created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $this->adminRepository->destroy($admin);
        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully');

    }
}

