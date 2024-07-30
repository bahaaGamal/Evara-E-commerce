@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

    <section class="content-main">
        <div class="row">
            <div class="col-10">
                <div class="content-header">
                    <h2 class="content-title">Add New Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <div class="card mb-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form id="send-data" method="POST" action="{{route('sellers.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>1. General info</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Shop Name</label>
                                        <input value="{{old('shop_name')}}" name="shop_name" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Address</label>
                                        <input value="{{old('address')}}" name="address" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Manager Name</label>
                                        <input value="{{old('manager_name')}}" name="manager_name" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Email</label>
                                        <input value="{{old('email')}}" name="email" type="email" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Phone Number</label>
                                        <input value="{{old('phone_number')}}" name="phone_number" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4 mt-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>2. Location</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Country</label>
                                        <input value="{{old('country')}}" name="country" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Postal Code</label>
                                        <input value="{{old('postal_code')}}" name="postal_code" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4 mt-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>3. Status</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option @selected(old('status') == 'active') value="active">Active</option>
                                            <option @selected(old('status') == 'disabled') value="disabled">Disabled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4 mt-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>4. Media</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Cover Image</label>
                                        <input type="file" name="cover_image" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Profile Image</label>
                                        <input type="file" name="profile_image" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button  type="submit" class="btn btn-primary width w-100">Publish</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section> <!-- content-main end// -->

@endsection

