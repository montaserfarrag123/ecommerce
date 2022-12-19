@extends('layouts.admin')
@section('title')
    My Order Of Deteails
@endsection
@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>My Orders
                    <a href="{{url('orders')}}" class="btn btn-warning text-white float-end">Back</a>
                </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 order-details">
                            <h4>Shiping Details</h4>
                            <hr>
                            <label for="">First Name</label>
                            <div class="border p-2">{{$orders->fname}}</div>
                            <label for="">Last Name</label>
                            <div class="border p-2">{{$orders->lname}}</div>
                            <label for="">Email</label>
                            <div class="border p-2">{{$orders->email}}</div>
                            <label for="">phone</label>
                            <div class="border p-2">{{$orders->phone}}</div>
                            <label for="">Shiping Address</label>
                            <div class="border p-2">
                                {{$orders->address1 }}  , <br>{{$orders->address2}} ,<br> {{$orders->city}} ,<br> {{$orders->state}} , {{$orders->country}}
                            </div>
                            <label for="">pincode</label>
                            <div class="border p-2">{{$orders->pincode}}</div>

                        </div>
                        <div class="col-md-6">
                            <h4>Order Details</h4>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders->orderitems as $order )
                                    <tr>
                                        <td>{{$order->products->name}}</td>
                                        <td>{{$order->qty}}</td>
                                        <td>{{$order->price}}</td>
                                        <td>
                                           <img src="{{asset('assets/product/'.$order->products->image)}}" width="50" height="50" alt="" srcset="">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 class="px-2">Grand Total : <span>{{$orders->total_price}}$</span></h4>
                            <div class="mt-3">
                            <label for="Order_status">Order Status</label>
                            <form action="{{url('update-order/'.$orders->id)}}" method="post">
                                @method('PUT')
                                @csrf
                            <select class="form-select" id="Order_status" name="Order_status">
                                <option {{$orders->status == '0' ? 'selected' :''}} value="0">Depending</option>
                                <option {{$orders->status == '1' ? 'selected' :''}} value="1">Compleate</option>
                              </select>

                              <button type="submit" class="btn btn-primary m-2">Update</button>
                            </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection



