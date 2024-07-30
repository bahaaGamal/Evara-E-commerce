@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

        <section class="content-main">
            <div class="content-header">
                <h2 class="content-title">Sellers</h2>
                <div>
                    <a href="{{Route("sellers.create")}}" class="btn btn-primary"><i class="material-icons md-plus"></i> Create new</a>
                </div>
            </div>
            <div class="card mb-4">
                <header class="card-header">
                    <div class="row gx-3">
                        <form class="d-flex" method="GET" action="{{ route('sellers.index') }}">
                            <div class="form-group col-lg-4 col-md-6 me-auto">
                                <input value="{{$searchTerm}}" name="search" type="text" placeholder="Search..." class="form-control" onchange="this.form.submit()">
                            </div>
                            <div class="form-group col-lg-2 col-6 col-md-3">
                                <select name="limit" class="form-select" onchange="this.form.submit()">
                                    <option @selected($limit == '20') value="20">Show 20</option>
                                    <option @selected($limit == '30') value="30">Show 30</option>
                                    <option @selected($limit == '40') value="40">Show 40</option>
                                    <option @selected($limit == '*') value="*">Show all</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-6 col-md-3">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option @selected($status == '') value="">Status: all</option>
                                    <option @selected($status == 'active') value="active">Active only</option>
                                    <option @selected($status == 'disabled') value="disabled">Disabled</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </header> <!-- card-header end// -->
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4">
                        @foreach ($sellers as $seller )
                        <div class="col">
                            <div class="card card-user">
                                <div class="card-header">
                                    <img class="img-md img-avatar" src="{{asset($seller->profile_image)}}" alt="User pic">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mt-50">{{$seller->shop_name}}</h5>
                                    <div class="card-text text-muted">
                                        <p class="m-0">Seller ID: #{{$seller->id}}</p>
                                        <p>{{$seller->email}}</p>
                                        <a href="{{Route("sellers.show",$seller->id)}}" class="btn btn-sm btn-brand rounded font-sm mt-15">View details</a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- col.// -->
                        @endforeach
                    </div> <!-- row.// -->
                </div> <!-- card-body end// -->
            </div> <!-- card end// -->
            <div class="pagination-area mt-15 mb-50">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item active"><a class="page-link" href="#">01</a></li>
                        <li class="page-item"><a class="page-link" href="#">02</a></li>
                        <li class="page-item"><a class="page-link" href="#">03</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">16</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </section> <!-- content-main end// -->

@endsection
