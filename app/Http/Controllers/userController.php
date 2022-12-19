<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;



class userController extends Controller
{
    public function index()
    {
        $orders = order::where('user_id',Auth::id())->get();
        return view('frontend.orders.index' , compact('orders'));
    }
    public function view($id){
        $orders = order::where('id',$id)->where('user_id',Auth::id())->first();
        return view('frontend.orders.view', compact('orders'));
    }
}
