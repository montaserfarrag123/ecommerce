@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card-md-12">
                <div class="card">
                    <div class="card-header bg-primary ">
                        <h4 class="text-white">Order History
                        <a href="{{url('orders')}}" class="btn btn-warning float-end">New Orders</a>
                    </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order Date</th>
                                    <th>Tracking Number</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order )
                                <tr>
                                    <td>{{ date('d-m-y',strtotime($order->created_at)) }}</td>
                                    <td>{{$order->tracking_no}}</td>
                                    <td>{{$order->total_price}}</td>
                                    <td>{{$order->status == 0 ? 'pending':'copleted'}}</td>
                                    <td>
                                        <a href="{{url('admin/view-orders/'.$order->id)}}" class="btn btn-primary">view</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
