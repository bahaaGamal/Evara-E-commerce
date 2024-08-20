@extends('layout.site')

@section('title') Evara Dashboard @endsection

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if ($cartItems->count() > 0)
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item )
                                    <tr>
                                        <td class="image product-thumbnail"><img src="/site/assets/imgs/shop/product-1-2.jpg" alt="#"></td>
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="shop-product-right.html">{{$item->name}}</a></h5>
                                            <p class="font-xs">{{$item->description}}</p>
                                        </td>
                                        <td class="price" data-title="Price"><span>${{$item->price}} </span></td>
                                        <td class="text-center" data-title="Stock">
                                            <div class="qty-box">
                                                <div class="input-group text-center">
                                                    <input type="number" name="quantity" data-rowid="{{$item->rowId}}" onchange="updateQuantity(this)" class="form-control input-number text-center" value="{{$item->qty}}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <span>${{$item->subtotal()}}</span>
                                        </td>
                                        <td class="action" data-title="Remove"><a href="javascript:void(0)" onclick="removeItemFromCart('{{$item->rowId}}')" class="text-muted"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-action text-end">
                            <a href="javascript:void(0)" onclick="clearCart()" class="btn  mr-10 mb-sm-15"><i class="fi-rs-trash mr-10"></i>Clear Cart</a>
                            <a href="{{Route('site.shop')}}" class="btn "><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            <div class="col-lg-6 col-md-12">
                                <div class="heading_s1 mb-3">
                                    <h4>Calculate Shipping</h4>
                                </div>
                                <form class="field_form shipping_calculator" method="post" action="{{route('orders.calculateShipping')}}">
                                    @include('inc.messages.errors')
                                    @include('inc.messages.session.error')
                                    @include('inc.messages.session.success')
                                    @csrf
                                    <div class="form-row row">
                                        <div class="form-group col-lg-6">
                                            <div class="custom_select">
                                                <select name="country" class="form-control select-active">
                                                    <option value="">Choose a country...</option>
                                                    @foreach ($shippings as $shipping )
                                                    <option value="{{$shipping->country}}">{{$shipping->country}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <div class="custom_select">
                                                <select name="city" class="form-control select-active">
                                                    <option value="">Choose a city...</option>
                                                    @foreach ($shippings as $shipping )
                                                    <option value="{{$shipping->city}}">{{$shipping->city}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-lg-6">
                                            <input placeholder="Address" name="address" type="text">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <input placeholder="Phone Number" name="phone" type="text">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <input placeholder="PostCode / ZIP" name="postal_code" type="text">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <button class="btn  btn-sm"><i class="fi-rs-shuffle mr-10"></i>Update</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="mb-30 mt-50">
                                    <div class="heading_s1 mb-3">
                                        <h4>Apply Coupon</h4>
                                    </div>
                                    <div class="total-amount">
                                        <div class="left">
                                            <div class="coupon">
                                                <form method="POST" action="{{ route('orders.applyCoupon') }}">
                                                    @csrf
                                                    <div class="form-row row justify-content-center">
                                                        <div class="form-group col-lg-6">
                                                            <input type="text" class="form-control font-medium" name="coupon_code" placeholder="Enter Your Coupon" required>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fi-rs-label mr-10"></i> Apply</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (session()->has('cart_total'))
                                <div class="col-lg-6 col-md-12">
                                    <div class="border p-md-4 p-30 border-radius cart-totals">
                                        <div class="heading_s1 mb-3">
                                            <h4>Cart Totals</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td class="cart_total_label">Cart Subtotal</td>
                                                        <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{Cart::instance('cart')->subtotal()}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cart_total_label">Shipping</td>
                                                        <td class="cart_total_amount"> <i class="ti-gift mr-5"></i>${{session()->get('shipping_cost')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cart_total_label">Total</td>
                                                        @if (session()->has('total_befor_discount'))
                                                        <td class="cart_total_amount">
                                                            <strong>
                                                                <span class="font-xl fw-900 text-brand mr-10" style="margin-left: 10px;">
                                                                    ${{ session()->get('cart_total') }}
                                                                </span>
                                                                <span class="font-xl fw-900 text-muted" style="text-decoration: line-through;">
                                                                    ${{ session()->get('total_befor_discount') }}
                                                                </span>
                                                            </strong>
                                                        </td>
                                                        @else
                                                        <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">${{session()->get('cart_total')}}</span></strong></td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <a class="btn " onclick="event.preventDefault(); document.getElementById('orders-store').submit();">
                                            <i class="fi-rs-box-alt mr-10"></i>
                                            Proceed To CheckOut
                                            <form id="orders-store" method="post" action="{{ route('orders.store') }}">
                                                @csrf
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>Your Cart is Empty !</h2>
                                <h5 class="mt-3">Add items to it now.</h5>
                                <a href="{{Route('site.shop')}}" class="btn btn-warning mt-15">Shop Now</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <form id="updateCartQty" action="{{route('cart.update')}}" method="POST">
            @csrf
            @method('put')
            <input type="hidden" id="rowId" name="rowId" />
            <input type="hidden" id="quantity" name="quantity" />
        </form>

        <form id="deleteFromCart" action="{{route('cart.remove')}}" method="post">
            @csrf
            @method('delete')
            <input type="hidden" id="rowId_D" name="rowId" />
        </form>

        <form id="clearCart" action="{{route('cart.clear')}}" method="post">
            @csrf
            @method('delete')
        </form>
    </main>
@endsection
@section('script')
    <script>
            function updateQuantity(qty) {
                var rowId = qty.getAttribute('data-rowid');
                var quantity = qty.value;

                document.getElementById('rowId').value = rowId;
                document.getElementById('quantity').value = quantity;

                document.getElementById('updateCartQty').submit();
            }

            function removeItemFromCart(rowId)
            {
                $('#rowId_D').val(rowId);
                $('#deleteFromCart').submit();
            }

            function clearCart()
            {
                $('#clearCart').submit();
            }

    </script>
@endsection
