@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

<section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Products</h2>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
                <div>
                    <a href="#" class="btn btn-light rounded font-md">Export</a>
                    <a href="#" class="btn btn-light rounded  font-md">Import</a>
                    <a href="{{Route('products.create')}}" class="btn btn-primary btn-sm rounded">Create new</a>
                </div>
            </div>
            <div class="card mb-4">
                <header class="card-header">
                    <div class="row gx-3">
                        <form class="d-flex" method="GET" action="{{ route('products.index') }}">
                            <div class="form-group col-lg-4 col-md-6 me-auto">
                                <input value="{{$searchTerm}}" name="search" type="text" placeholder="Search..." class="form-control" onchange="this.form.submit()">
                            </div>
                            <div class="form-group col-lg-2 col-6 col-md-3">
                                <select name="category_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">All category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @selected($category->id == $selectedCategory)>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-6 col-md-3">
                                <select name="sort_by" class="form-select" onchange="this.form.submit()">
                                    <option value="latest_added" @selected($sortBy == 'latest_added')>Latest added</option>
                                    <option value="cheap_first" @selected($sortBy == 'cheap_first')>Cheap first</option>
                                    <option value="most_viewed" @selected($sortBy == 'most_viewed')>Most viewed</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </header> <!-- card-header end// -->
                <div class="card-body">
                    <div class="alert alert-danger d-none text-center bold" id="show-message"></div>
                    <div class="row gx-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5">
                        @foreach ($products as $product )
                        <div class="col">
                            <div class="card card-product-grid">
                                <a href="{{ route('products.show', $product->id) }}" class="img-wrap"> <img src="{{asset($product->image)}}" alt="Product" style="height: 200px !important; width: 200px !important;"> </a>
                                <div class="info-wrap">
                                    <a href="{{ route('products.show', $product->id) }}" class="title text-truncate">{{$product->title}}</a>
                                    <div class="price mb-2">${{$product->price}}</div> <!-- price.// -->
                                    <a href="{{Route('products.edit',$product->id)}}" class="btn btn-sm font-sm rounded btn-brand">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <form class="delete-tag" style="display: inline;" method="POST" action="{{Route('products.destroy',$product->id)}}" onclick="return confirm('Are you sure you want to delete this product?')">
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
        <div>
            {{$products->links()}}
        </div>
        </section> <!-- content-main end// -->

@endsection

@section('script')
    <script>
        let item =document.querySelectorAll(".delete-tag");
        let messageElemnt = document.getElementById('show-message');

        item.forEach(element => {
            element.addEventListener('submit',function(e){
                e.preventDefault();

                let token =document.querySelector("input[name='_token']");

                fetch(element.action,{
                method: 'DELETE',
                headers:{
                    'X-CSRF-TOKEN': token.value,
                    'Accept':"application/json",
                    'Content-Type':"application/json",
                }}).then(data => {
               return data.json()
            }).then(data => {
                messageElemnt.classList.remove('d-none');
                if(data['status']){
                    messageElemnt.classList.remove('alert-danger');
                    messageElemnt.classList.add('alert-success');
                    element.closest('.col').remove();
                }else{
                    messageElemnt.classList.remove('alert-success');
                    messageElemnt.classList.add('alert-danger');
                }
                messageElemnt.textContent = data.message;
            })
        })
        });


    </script>

@endsection
