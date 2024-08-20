@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

        <section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Update Categories </h2>
                    <p>Add, edit or delete a category</p>
                </div>
                <div>
                    <input type="text" placeholder="Search Categories" class="form-control bg-white">
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
                            <form method="POST" action="{{Route('categories.update',$category->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Name</label>
                                    <input type="text" value="{{$category->name}}" placeholder="Type here" class="form-control" name="name" id="product_name" />
                                </div>
                                <div class="mb-4">
                                    <label for="product_slug" class="form-label">Slug</label>
                                    <input type="text" value="{{$category->slug}}" placeholder="Type here" name="slug" class="form-control" id="product_slug" />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Parent</label>
                                    <select name="parent" class="form-select">
                                        @foreach ($categories as $one )
                                        <option @selected($one->id == $category->parent) value="{{$one->id}}">{{$one->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" placeholder="Type here" class="form-control">{{$category->description}}</textarea>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary">Update category</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- .row // -->
                </div> <!-- card body .// -->
            </div> <!-- card .// -->
        </section> <!-- content-main end// -->

@endsection
