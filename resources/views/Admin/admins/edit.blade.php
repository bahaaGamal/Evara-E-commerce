@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

    <section class="content-main">
        <div class="row">
            <div class="col-10">
                <div class="content-header">
                    <h2 class="content-title">Edit Admin</h2>
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
                    <form id="send-data" method="POST" action="{{route('admins.update',$admin->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>1. General info</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Name</label>
                                        <input value="{{$admin->name}}" name="name" type="text" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Email</label>
                                        <input value="{{$admin->email}}" name="email" type="email" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Phone Number</label>
                                        <input value="{{$admin->phone}}" name="phone" type="text" placeholder="Type here" class="form-control">
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
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control">
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
                                        <option @selected($admin->status == 'admin') value="admin">Admin</option>
                                        <option @selected($admin->status == 'sub_admin') value="sub_admin">Sub Admin</option>
                                        </select>
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
