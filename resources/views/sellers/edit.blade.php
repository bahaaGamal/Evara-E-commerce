@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

    <section class="content-main">
        <div class="row">
            <div class="col-10">
                <div class="content-header">
                    <h2 class="content-title">Edit Product</h2>
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
                    <form id="send-data" method="POST" action="{{route('sellers.update',$seller->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>1. General info</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Shop Name</label>
                                        <input value="{{$seller->shop_name}}" name="shop_name" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Address</label>
                                        <input value="{{$seller->address}}" name="address" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Manager Name</label>
                                        <input value="{{$seller->manager_name}}" name="manager_name" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Email</label>
                                        <input value="{{$seller->email}}" name="email" type="email" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Phone Number</label>
                                        <input value="{{$seller->phone}}" name="phone_number" type="text" placeholder="Type here" class="form-control">
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
                                        <input value="{{$seller->country}}" name="country" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Postal Code</label>
                                        <input value="{{$seller->postal_code}}" name="postal_code" type="text" placeholder="Type here" class="form-control">
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
                                            <option value="active">Active</option>
                                            <option value="disabled">Disabled</option>
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
                        <button  type="submit" class="btn btn-primary width w-100">Update</button>
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
