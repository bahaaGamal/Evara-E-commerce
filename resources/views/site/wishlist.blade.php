@extends('layout.site')

@section('title') Evara Dashboard @endsection

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Wishlist
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                @if ($items->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col" colspan="2">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock Status</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $items as $item )
                                    <tr>
                                        <td class="image product-thumbnail"><img src="/site/assets/imgs/shop/product-1-1.jpg" alt="#"></td>
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="shop-product-right.html">{{$item->name}}</a></h5>
                                        </td>
                                        <td class="price" data-title="Price"><span>${{$item->price}} </span></td>
                                        <td class="text-center" data-title="Stock">
                                            <span class="color3 font-weight-bold">In Stock</span>
                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <a href="javascript:void(0)" onclick="moveToCart('{{$item->rowId}}')" class="btn btn-sm"><i class="fi-rs-shopping-bag mr-5"></i>Add to cart</a>
                                        </td>
                                        <td class="action" data-title="Remove"><a href="javascript:void(0)" class="icon" onclick="removeFromWishlist('{{$item->rowId}}')"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Your WishList is Empty !</h2>
                        <h5 class="mt-3">Add items to it now.</h5>
                        <a href="{{Route('site.shop')}}" class="btn btn-warning mt-15">Shop Now</a>
                    </div>
                </div>
                @endif
            </div>
        </section>
        <form id="deleteFromWishlist" action="{{route('wishlist.remove')}}" method="POST">
            @csrf
            @method('delete')
            <input type="hidden" id="rowId" name="rowId" />
        </form>

        <form id="moveToCart" action="{{route('wishlist.move.to.cart')}}" method="POST">
            @csrf
            <input type="hidden" name="rowId" id="mrowId" />
        </form>
    </main>
@endsection
@section('script')
  <script>
    function removeFromWishlist(rowId)
    {
        $("#rowId").val(rowId);
        $("#deleteFromWishlist").submit();
    }

    function moveToCart(rowId)
    {
        $("#mrowId").val(rowId);
        $("#moveToCart").submit();
    }
  </script>
@endsection
