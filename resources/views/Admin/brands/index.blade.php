@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

        <section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Brands </h2>
                    <p>Brand and vendor management</p>
                </div>
                <div>
                    <a href="{{Route('brands.create')}}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Add New Brand</a>
                </div>
            </div>
            <div class="card mb-4">
                <header class="card-header">
                    <div class="row gx-3">
                        <form class="d-flex" method="GET" action="{{ route('brands.index') }}">
                            <div class="col-lg-4 mb-lg-0 mb-15 me-auto">
                                <input value="{{$searchTerm}}" name="search" type="text" placeholder="Search..." class="form-control" onchange="this.form.submit()">
                            </div>
                            <div class="col-lg-2 col-6">
                                <div class="custom_select">
                                    <select name="category_id" class="form-select select-nice" onchange="this.form.submit()">
                                    <option value="">All category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @selected($category->id == $selectedCategory)>{{$category->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </header> <!-- card-header end// -->
                <div class="card-body">
                    <div class="row gx-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5">
                     @foreach ($brands as $brand )
                        <div class="col">
                            <figure class="card border-1">
                                <div class="card-header bg-white text-center">
                                    <img height="76" src="assets/imgs/brands/brand-1.jpg" class="img-fluid" alt="Logo">
                                </div>
                                <figcaption class="card-body text-center">
                                    <h6 class="card-title m-0">{{$brand->name}}</h6>
                                    <p href="#"> {{count($brand->products)}} items </p>
                                    <a href="{{Route('brands.edit',$brand->id)}}" class="btn btn-sm font-sm rounded btn-brand">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <form class="delete-tag" style="display: inline;" method="POST" action="{{Route('brands.destroy',$brand->id)}}" onclick="return confirm('Are you sure you want to delete this admin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm font-sm btn-light rounded">
                                            <i class="material-icons md-delete_forever"></i> Delete
                                        </button>
                                    </form>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->
                        @endforeach
                    </div> <!-- row.// -->
                </div> <!-- card-body end// -->
            </div> <!-- card end// -->
        </section> <!-- content-main end// -->

@endsection
