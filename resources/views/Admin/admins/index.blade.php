@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

<section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Admins</h2>
                </div>
                <div>
                    <a href="{{Route('admins.create')}}" class="btn btn-primary btn-sm rounded">Create new</a>
                </div>
            </div>
            <div class="card mb-4">
                <header class="card-header">
                    <div class="row gx-3">
                        <form class="d-flex" method="GET" action="{{ route('admins.index') }}">
                            <div class="form-group col-lg-4 col-md-6 me-auto">
                                <input value="{{$searchTerm}}" name="search" type="text" placeholder="Search..." class="form-control" onchange="this.form.submit()">
                            </div>
                            <div class="form-group col-lg-2 col-6 col-md-3">
                                <select name="admin_type" class="form-select" onchange="this.form.submit()">
                                    <option value="">All Admin</option>
                                    <option @selected($adminType == 'admin') value="admin">Admin</option>
                                    <option @selected($adminType == 'sub_admin') value="sub_admin">Sub Admin</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </header> <!-- card-header end// -->
                <div class="card-body">
                    <div class="alert alert-danger d-none text-center bold" id="show-message"></div>
                    <div class="row gx-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5">
                        @foreach ($admins as $admin )
                        <div class="col">
                            <div class="card card-product-grid">
                                <img src="{{asset($admin->image)}}" alt="Product" style="height: 200px !important; width: 200px !important;">
                                <div class="info-wrap">
                                    <h4 class="title text-truncate">{{$admin->name}}</h4>
                                    <div class="price mb-2">{{$admin->email}}</div> <!-- price.// -->
                                    <a href="{{Route('admins.edit',$admin->id)}}" class="btn btn-sm font-sm rounded btn-brand">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <form class="delete-tag" style="display: inline;" method="POST" action="{{Route('admins.destroy',$admin->id)}}" onclick="return confirm('Are you sure you want to delete this admin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm font-sm btn-light rounded">
                                            <i class="material-icons md-delete_forever"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div> <!-- card-product  end// -->
                        </div> <!-- col.// -->
                        @endforeach
                    </div> <!-- row.// -->
                </div> <!-- card-body end// -->
            </div> <!-- card end// -->
        </section> <!-- content-main end// -->

@endsection

