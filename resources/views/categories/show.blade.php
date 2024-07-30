@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

<section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">{{ $category['name'] }}</h2>
                </div>
            </div>
            <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{ $category['description'] }}</p>
                            <ul class="list-group">
                                <li class="list-group-item">Slug : {{ $category->slug }}</li>
                                <li class="list-group-item">Parent : {{ $category->parentCategory->name }}</li>
                                <li class="list-group-item">Products :
                                    @foreach ($category->products as $product )
                                       <div> {{$product->title}}</div>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
