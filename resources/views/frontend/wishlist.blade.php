@extends('layouts.frontend')
@section('title')
    My wish
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h4 class="mb-0 ">
            <a href="{{url('/')}}" class="text-dark">Home</a>/
            <a href="{{url('wishlist')}}" class="text-dark">My Wishlist</a>
        </h4>
    </div>
</div>

    <div class="container my-2 ">
        <div class="card shadow">
            <div class="card-body">
                @if ($wishlist->count() > 0)
                <div class="card-body">

                    @foreach ($wishlist as $wish)
                    @php $total = 0; @endphp

                    <div class="row product_data">
                        <div class="col-md-2">
                            <img src="{{asset('assets/product/' . $wish->product->image) }}" width="70px" height="70px" alt="hbh" srcset="">
                        </div>
                        <div class="col-md-2 my-auto">
                          <h5>{{$wish->product->name}}</h5>
                        </div>
                        <div class="col-md-2 my-auto">
                            Rs: {{$wish->product->selling_price}}
                        </div>
                        <div class="col-md-2 my-auto">
                            <input type="hidden" value="{{$wish->prod_id}}" class="prod_id">
                            @if ($wish->product->qty >= $wish->prod_qty)

                            {{-- <h1 class="badge bg-success text-wrap" style="width: 6rem;"> In Stock</h1> --}}

                         <label for="Quantity " class="text-danger ">Quantity</label>
                        <div class="input-group text-center mb-3" style="width:120px">
                            <button class="input-group-text  decrement-btn">-</button>
                            <input type="text" name="quantity" value='1' class="form-control qty-input" />
                            <button class="input-group-text  increment-btn">+</button>
                        </div>


                            @else

                            {{-- <h1 class="badge bg-danger text-wrap" style="width: 6rem;"> Out Of Stock</h1>--}}


                            @endif
                        </div>
                            <div class="col-md-4 my-auto">
                                <button class="btn btn-danger remove-wishlist-item"> <i class="fa fa-trash"></i> Dlete</button>
                                <button class="btn btn-primary addToCartBtn"> <i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
                            </div>

                            {{-- <div class="col-md-2">
                                <button class="btn btn-danger "> <i class="fa fa-trash"></i> Add</button>
                            </div> --}}
                        </div>

                        @endforeach
                    </div>
                    <div class="card-footer">
                        <h6>Total Price:{{$total}}$
                        <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Proceed To Checkoute</a>
                    </h6>
                    </div>
                @else
                <h4>There Are No Product In Wishlist</h4>
                @endif
            </div>
        </div>
    @endsection
    @section('scripts')
        {{-- <script>
        $('.delete-wish-item').click(function(e){
            e.preventDefault();

            var prod_id =$(this).closest('.product_data').find('.prod_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           $.ajax({
            method: "post",
            url: "delete-wish-item",
            data: {
                'prod_id':prod_id,
            },
            success:function(response) {
                window.location.reload();
                swal("",response.status,"success");
            }
           });
        });
    </script> --}}
     @endsection

