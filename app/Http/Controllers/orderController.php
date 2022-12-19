<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function index()
    {
        $orders =order::where('status','0')->get();
        return view('admin.orders.index' ,compact('orders'));
    }
    public function view($id)
    {
        $orders = order::where('id' , $id)->first();
        return view('admin.orders.view' , compact('orders'));
    }
    public function updateOrder(Request $request , $id)
    {
        $orders = Order::find($id);
        $orders->status = $request->input('Order_status');
        $orders->update();
        return redirect('orders')->with('status' , "Order Updated Successfully");

    }
    public function orderHistory()
    {
        $orders =order::where('status','1')->get();
        return view('admin.orders.history' ,compact('orders'));
    }
}
