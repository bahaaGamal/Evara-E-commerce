@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

        <section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Categories </h2>
                    <p>Add, edit or delete a category</p>
                </div>
                <form method="GET" action="{{ route('categories.index') }}">
                    <div class="form-group">
                        <input value="{{$searchTerm}}" name="search" type="text" placeholder="Search Categories" class="form-control bg-white" onchange="this.form.submit()">
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form method="POST" action="{{Route('categories.store')}}">
                                @csrf
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Name</label>
                                    <input type="text" placeholder="Type here" class="form-control" name="name" id="product_name" />
                                </div>
                                <div class="mb-4">
                                    <label for="product_slug" class="form-label">Slug</label>
                                    <input type="text" placeholder="Type here" name="slug" class="form-control" id="product_slug" />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Parent</label>
                                    <select name="parent" class="form-select">
                                        @foreach ($categories as $category )
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" placeholder="Type here" class="form-control"></textarea>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary">Create category</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Slug</th>
                                            <th>Order</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category )
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td><b>{{$category->name}}</b></td>
                                            <td>{{$category->description}}</td>
                                            <td>{{$category->slug}}</td>
                                            <td>1</td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('categories.show', $category['id'])}}">View detail</a>
                                                        <a class="dropdown-item" href="{{route('categories.edit', $category['id'])}}">Edit info</a>
                                                        <form style="display: inline;" method="POST" action="{{route('categories.destroy', $category['id'])}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item">Delete</button>
                                                        </form>
                                                    </div>
                                                </div> <!-- dropdown //end -->
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- .col// -->
                    </div> <!-- .row // -->
                </div> <!-- card body .// -->
            </div> <!-- card .// -->
        </section> <!-- content-main end// -->

@endsection
