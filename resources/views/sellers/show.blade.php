@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

        <section class="content-main">
            <div class="content-header">
                <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i> Go back </a>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-primary" style="height:150px">
                    <img style="height:100%; width:100%" src="{{asset($seller->cover_image)}}" alt="">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl col-lg flex-grow-0" style="flex-basis:230px">
                            <div class="img-thumbnail shadow w-100 bg-white position-relative text-center" style="height:190px; width:200px; margin-top:-120px">
                                <img src="{{asset($seller->profile_image)}}" class="center-xy img-fluid" alt="Logo Brand">
                            </div>
                        </div> <!--  col.// -->
                        <div class="col-xl col-lg">
                            <h3>{{$seller->shop_name}}</h3>
                            <p>{{$seller->address}}, {{$seller->country}} {{$seller->postal_code}}</p>
                        </div> <!--  col.// -->
                        <div class="col-xl-4 text-md-end">
                            <select onchange="handleSelectChange(this)" seller-id="{{ $seller->id }}" class="form-select w-auto d-inline-block">
                                <option>Actions</option>
                                <option value="edit">Edit</option>
                                <option value="delete">Delete</option>
                                <option value="toggle_status">
                                    {{ $seller->status == 'active' ? 'Disable' : 'Active' }}
                                </option>
                            </select>

                            <form id="delete-form" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <form id="status-form" method="POST" style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>
                            <a href="#" class="btn btn-primary"> View live <i class="material-icons md-launch"></i> </a>
                        </div> <!--  col.// -->
                    </div> <!-- card-body.// -->
                    <hr class="my-4">
                    <div class="row g-4">
                        <div class="col-md-12 col-lg-4 col-xl-2">
                            <article class="box">
                                <p class="mb-0 text-muted">Total sales:</p>
                                <h5 class="text-success">238</h5>
                                <p class="mb-0 text-muted">Revenue:</p>
                                <h5 class="text-success mb-0">$2380</h5>
                            </article>
                        </div> <!--  col.// -->
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <h6>Contacts</h6>
                            <p>
                                Manager: {{$seller->manager_name}} <br>
                                {{$seller->email }} <br>
                                {{$seller->phone}}
                            </p>
                        </div> <!--  col.// -->
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <h6>Address</h6>
                            <p>
                                Country: {{$seller->country}} <br>
                                Address: {{$seller->address}} <br>
                                Postal code: {{$seller->postal_code}}
                            </p>
                        </div> <!--  col.// -->
                        <div class="col-sm-6 col-xl-4 text-xl-end">
                            <map class="mapbox position-relative d-inline-block">
                                <img src="/assets/imgs/misc/map.jpg" class="rounded2" height="120" alt="map">
                                <span class="map-pin" style="top:50px; left: 100px"></span>
                                <button class="btn btn-sm btn-brand position-absolute bottom-0 end-0 mb-15 mr-15 font-xs"> Large </button>
                            </map>
                        </div> <!--  col.// -->
                    </div> <!--  row.// -->
                </div> <!--  card-body.// -->
            </div> <!--  card.// -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Products by seller</h5>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <div class="card card-product-grid">
                                <a href="#" class="img-wrap"> <img src="/assets/imgs/items/1.jpg" alt="Product"> </a>
                                <div class="info-wrap">
                                    <a href="#" class="title">Product name</a>
                                    <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
                                </div>
                            </div> <!-- card-product  end// -->
                        </div> <!-- col.// -->
                    </div> <!-- row.// -->
                </div> <!--  card-body.// -->
            </div> <!--  card.// -->
        </section> <!-- content-main end// -->

@endsection

@section('script')
       <script>
         function handleSelectChange(select) {
            var action = select.value;
            var sellerId = select.getAttribute('seller-id');

            if (action === "edit") {
                window.location.href = '/sellers/' + sellerId + '/edit';
            } else if (action === "delete") {
                var form = document.getElementById('delete-form');
                form.action = '/sellers/' + sellerId;
                if (confirm('Are you sure you want to delete this item?')) {
                    form.submit();
                } else {
                    select.value = ""; // Reset the select
                }
            } else if (action === "toggle_status") {
                var form = document.getElementById('status-form');
                form.action = '/sellers/' + sellerId + '/toggle-status';
                form.submit();
            }
        }
       </script>

@endsection
