@extends('layouts.frontend')
@section('title')
    Checkout
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h4 class="mb-0">
            <a href="{{url('/')}}"class="text-dark">Home</a> /
            <a href="{{url('checkout')}}" class="text-dark">Checkoute</a>
        </h4>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
<div class="container mt-5 mb-5">
    <form action="{{url('place-order')}}" method="POST">
        @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h2>Basic Details</h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="firstName" class="form-label ">First Name</label>
                                <input type="text" name="fname" value="{{Auth::user()->name}}" placeholder="Enter The First Name" class="form-control firstName" id="firstName">
                                <span id="fname_error" class="text-danger"></span>
                              </div>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="lastName" class="form-label ">Last Name</label>
                                <input type="text" name="lname" value="{{Auth::user()->lname}}" placeholder="Enter The Last Name" class="form-control lastName" id="lastName">
                                <span id="lastName_error" class="text-danger"></span>
                              </div>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="email" class="form-label ">Email</label>
                                <input type="email" name="email" value="{{Auth::user()->email}}" placeholder="Enter The Email" class="form-control email" id="email">
                                <span id="email_error" class="text-danger"></span>
                              </div>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="phone" name="phone" value="{{Auth::user()->phone}}" placeholder="Enter The Phone Number" class="form-control phone" id="phone">
                                <span id="phone_error" class="text-danger"></span>
                              </div>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="address1" class="form-label">Address 1</label>
                                <input type="text" name="address1" value="{{Auth::user()->address1}}" placeholder="Enter The Address 1" class="form-control address1" id="address1">
                              </div>
                              <span id="address1_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="address2" class="form-label">Address 2</label>
                                <input type="text" name="address2" value="{{Auth::user()->address2}}" placeholder="Enter The Address 2" class="form-control address2" id="address2">
                              </div>
                              <span id="address2_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" value="{{Auth::user()->city}}" placeholder="Enter The City" class="form-control city" id="city">
                                <span id="city_error" class="text-danger"></span>
                              </div>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" name="state" value="{{Auth::user()->state}}" placeholder="Enter The State" class="form-control state" id="state">
                                <span id="state_error" class="text-danger"></span>
                              </div>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" name="country" value="{{Auth::user()->country}}" placeholder="Enter The Country" class="form-control country" id="country">
                                <span id="country_error" class="text-danger"></span>
                              </div>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="pincode" class="form-label">Pin Code</label>
                                <input type="text" name="pincode" value="{{Auth::user()->pincode}}" placeholder="Enter The First Name" class="form-control pincode" id="firstName">
                                <span id="pincode_error" class="text-danger"></span>
                              </div>
                        </div>
                    </div>
                </div> <!-- card-body -->
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2>Order Details</h2>
                    <hr>
                    @if ($cartitem->count() > 0)


                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 ; @endphp


                            @foreach ($cartitem as $item)
                            <tr>
                                @php $total += ($item->product->selling_price * $item->prod_qty)   @endphp
                                <td> {{$item->product->name}}</td>
                                <td>{{$item->prod_qty}}</td>
                                <td>{{$item->product->selling_price}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h6> Grand Total <span class="float-end">Rs {{$total}}$</span> </h6>
                    <hr>
                    <input type="hidden" name="payment_mode" value="COD">
                    <button type="submit" class="btn btn-success float-end w-100">Place Order | COD</button>
                    <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Pay With Razorpay</button>
                    @else
                    <h4 class="text-center text-danger">No Products In Cart</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
</div>


@endsection
@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection

