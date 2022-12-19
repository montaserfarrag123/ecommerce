@extends('layouts.frontend')
@section('title')
    My Cart
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h4 class="mb-0">
            collection /  /
        </h4>
    </div>
</div>

    <div class="container my-2 ">
        <div class="card shadow">
            @if ($cartItem->count()>0)

            <div class="card-body">
                @php $total = 0; @endphp
                @foreach ($cartItem as $cart )

                <div class="row product_data">
                    <div class="col-md-2">
                        <img src="{{asset('assets/product/' . $cart->product->image) }}" width="70px" height="70px" alt="hbh" srcset="">
                    </div>
                    <div class="col-md-3 my-auto">
                      <h5>{{$cart->product->name}}</h5>
                    </div>
                    <div class="col-md-2 my-auto">
                        Rs: {{$cart->product->selling_price}}
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" value="{{$cart->prod_id}}" class="prod_id">
                        @if ($cart->product->qty >= $cart->prod_qty)
                        <label for="Quantity " class="text-danger ">Quantity</label>
                        <div class="input-group text-center mb-3" style="width:120px">
                            <button class="input-group-text changeQuantity decrement-btn">-</button>
                            <input type="text" name="quantity" value='{{$cart->prod_qty}}' class="form-control qty-input" />
                            <button class="input-group-text changeQuantity increment-btn">+</button>
                        </div>
                        @php $total +=$cart->product->selling_price * $cart->prod_qty ; @endphp
                        @else

                        <h1 class="badge bg-danger text-wrap" style="width: 6rem;">
                            Out Of Stock
                          </h5>
                        @endif
                    </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"></i> Dlete</button>
                        </div>
                    </div>

                    @endforeach
                </div>
                <div class="card-footer">
                    <h6>Total Price:{{$total}}$
                    <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Proceed To Checkoute</a>
                </h6>
                </div>
                @else
                <div class="card-body text-center">
                    <h2>you <i class="fa fa-shopping-cart"></i> Cart Is Empty </h2>
                    <a href="{{url('category')}}" class="btn btn-outline-primary float-end">Continue Shopping</a>
                </div>
                @endif
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
        $('.delete-cart-item').click(function(e){
            e.preventDefault();

            var prod_id =$(this).closest('.product_data').find('.prod_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           $.ajax({
            method: "post",
            url: "delete-cart-item",
            data: {
                'prod_id':prod_id,
            },
            success:function(response) {
                window.location.reload();
                swal("",response.status,"success");
            }
           });
        });
    </script>
     @endsection

