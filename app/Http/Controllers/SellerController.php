<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sellers = Seller::all();
        $searchTerm = $request->get('search');
        $status = $request->get('status');
        $limit = $request->get('limit');

        $sellers = Seller::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('shop_name', 'like', "%{$searchTerm}%");
        });

        $sellers = $sellers->take($limit)->get();

        return view('sellers.index', compact('sellers','searchTerm','limit' ,'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'manager_name' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:sellers',
            'phone_number' => 'required|string|max:30',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'status' => 'required|in:active,disabled',
        ]);

        $coverImageName = request()->file('cover_image')->store('public');
        $profileImageName = request()->file('profile_image')->store('public');

        Seller::create([
            'shop_name' => $request->shop_name,
            'address' => $request->address,
            'cover_image' => $coverImageName,
            'profile_image' => $profileImageName,
            'manager_name' => $request->manager_name,
            'email' => $request->email,
            'phone' => $request->phone_number,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'status' => $request->status,
        ]);

        return to_route('sellers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seller $seller)
    {
        return view('sellers.show', compact('seller'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seller $seller)
    {
        return view('sellers.edit', compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seller $seller)
    {
        $oldCoverImageName = $seller->cover_image;
        $oldProfileImageName = $seller->profile_image;
        $request->validate([
            'shop_name' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'manager_name' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:30',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'status' => 'required|in:active,disabled',
        ]);

        $seller->shop_name = $request->shop_name;
        $seller->address = $request->address;
        $seller->manager_name = $request->manager_name;
        $seller->email = $request->email;
        $seller->phone = $request->phone_number;
        $seller->country = $request->country;
        $seller->postal_code = $request->postal_code;
        $seller->status = $request->status;


        if(request()->hasFile('cover_image')){
            $new_cover_image = request()->file('cover_image')->store('public');
            File::delete($oldCoverImageName);
            $seller->cover_image = $new_cover_image;
        }

        if(request()->hasFile('profile_image')){
            $new_profile_image = request()->file('profile_image')->store('public');
            File::delete($oldProfileImageName);
            $seller->profile_image = $new_profile_image;
        }

        $seller->save();


        return to_route('sellers.index');
    }

    public function toggleStatus($id)
    {
        $seller = Seller::find($id);
        $seller->status = $seller->status == 'active' ? 'disabled' : 'active';
        $seller->save();

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();

        return to_route('sellers.index');
    }
}
