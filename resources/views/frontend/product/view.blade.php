@extends('layouts.frontend')
@section('title', $products->name)

@section('content')

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h4 class="mb-0">
                collection / {{$products->category->name}} / {{$products->name}}
            </h4>
        </div>
    </div>

    <div class="container">
        <div class="card shadow-lg p-3 mb-5 bg-body rounded product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/product/' . $products->image) }}" width="300" height="250" alt="" srcset="">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $products->name }}
                            @if ($products->treding == '1')
                            <label style="font-size: 16px" class="float-end badge bg-danger trending_tag">Trending</label>
                            @endif
                        </h2>
                        <hr>
                        <label class="me-3"> Priginal Price Rs: <s>{{ $products->original_price }}</s> </label>
                        <label class="fw-bold"> Selling Price Rs: {{ $products->selling_price }} </label>
                        <p class="mt-4">{!! $products->small_description !!}</p>
                        <hr>
                        @if ($products->qty > 0)
                            <label class="badge bg-success">In Stock</label>
                        @else
                            <label class="badge bg-danger">Out Of Stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <input type="hidden" value="{{$products->id}}" class="prod_id">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" value='1' class="form-control qty-input" />
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-10 pt-4">
                                @if ($products->qty > 0)
                                <button type="button" class="btn btn-primary me-3 float-start addToCartBtn"> <i class="fa-solid fa-cart-shopping"></i> Add To cart</button>

                            @endif

                                <button type="button" class="btn btn-success me-3 addToWishlist float-start "><i class="fa-solid fa-heart"></i> Add To Wishlist</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')



@endsection
