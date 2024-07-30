@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

        <section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Create Brands </h2>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form method="POST" action="{{Route('brands.store')}}">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" placeholder="Type here" class="form-control" name="name" id="product_name" />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        @foreach ($categories as $category )
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="File" class="form-control" name="name" id="product_name" />
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary">Create Brand</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- .row // -->
                </div> <!-- card body .// -->
            </div> <!-- card .// -->
        </section> <!-- content-main end// -->

@endsection
