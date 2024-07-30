@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

    <section class="content-main">
        <div class="row">
            <div class="col-10">
                <div class="content-header">
                    <h2 class="content-title">Update Product</h2>
                    <div>
                        <button id="publich-button" class="btn btn-md rounded font-sm hover-up">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <div class="card mb-4">
                    <form id="send-data" method="POST" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                        <div class="alert alert-danger d-none text-center bold" id="show-message"></div>
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>1. General info</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Product title</label>
                                        <input value="{{$product->title}}" name="title" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" placeholder="Type here" class="form-control" rows="4">{{$product->description}}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Brand name</label>
                                        <select name="brand" class="form-select">
                                            @foreach ($brands as $brand )
                                                <option @selected($brand->id == $product->brand_id) value="{{$brand->id}}"> {{$brand->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <!-- col.// -->
                            </div> <!-- row.// -->
                            <hr class="mb-4 mt-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>2. Pricing</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Cost in USD</label>
                                        <input value="{{$product->price}}" name="price" type="text" placeholder="$00.0" class="form-control">
                                    </div>
                                </div> <!-- col.// -->
                            </div> <!-- row.// -->
                            <hr class="mb-4 mt-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>3. Category</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                    @foreach ($categories as $category )
                                        <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                            <input @checked($category->id == $product->category_id) value="{{$category->id}}" class="form-check-input" name="category" type="radio">
                                            <span class="form-check-label">{{$category->name}} </span>
                                        </label>
                                    @endforeach
                                    </div>
                                </div> <!-- col.// -->
                            </div> <!-- row.// -->
                            <hr class="mb-4 mt-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>4. Media</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Images</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div> <!-- col.// -->
                            </div> <!-- .row end// -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section> <!-- content-main end// -->

@endsection

@section('script')

    <script>
        document.getElementById('publich-button').addEventListener('click', function(e) {
            e.preventDefault();

            let formElement = document.getElementById('send-data');
            let formData = new FormData(formElement);

            fetch(formElement.action, {
                method: 'POST',
                headers: {
                    // 'X-CSRF-TOKEN': token,
                    'Accept': "application/json",
                    // 'Content-Type': "application/json",
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                let messageElemnt = document.getElementById('show-message');
                messageElemnt.classList.remove('d-none');
                if (data.status === 'success') {
                    messageElemnt.classList.remove('alert-danger');
                    messageElemnt.classList.add('alert-success');
                } else {
                    messageElemnt.classList.remove('alert-success');
                    messageElemnt.classList.add('alert-danger');
                }
                messageElemnt.textContent = data.message;
            })
            .catch(error => console.error('Error:', error));
        });
    </script>

@endsection
