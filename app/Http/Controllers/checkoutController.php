<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\product;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\user;
use Illuminate\Support\Facades\Auth;


class checkoutController extends Controller
{
    public function index()
    {

        $oldcartitem = cart::where('user_id', Auth::id())->get();

        foreach($oldcartitem as $item){
            if(!product::where('id',$item->prod_id)->where('qty','>=',$item->prod_id)->exists()){
                $removeitem = cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
                $removeitem->delete();
            }
        }
            $cartitem =cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout',compact('cartitem'));
    }

    public function placeOrder(Request $request)
    {
        $this->validate($request,[
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address1'=>'required',
            'address2'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'pincode'=>'required',
        ]);
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');
        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id = $request->input('payment_id');
        //total price
        $total = 0;
        $cartitem_total = cart::where('user_id',Auth::id())->get();
        foreach($cartitem_total as $prod){
            $total += $prod->product->selling_price;
        }
        $order->total_price = $total;
        $order->tracking_no = 'montaser'. rand(1111,9999);
        $order->save();


        $cartitems = cart::where('user_id',Auth::id())->get();
        foreach($cartitems as $item){
            orderitem::create([
                'order_id'=> $order->id,
                'prod_id'=> $item->product->id,
                'qty'=> $item->prod_qty,
                'price'=> $item->product->selling_price,
             ]);
             $prod = product::where('id',$item->prod_id)->first();
             $prod->qty = $prod->qty - $item->prod_qty;
             $prod->update();
        }
        if(Auth::user()->address1 == null){

        $user = user::where('id' , Auth::id())->first();
        $user->name = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->phone = $request->input('phone');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->pincode = $request->input('pincode');
        $user->update();
        }
        cart::destroy($cartitems);

        if($request->input('payment')=='Paid by Razorpay'){
            return response()->json(['status' => 'Orderd Placed Successfully']);
        }
        return redirect('/')->with('status','Orderd Placed Successfully');
    }

    public function razorpayCheck(Request $request)
    {
        $cart_item = cart::where('user_id' , Auth::id())->get();
        $total_price=0;
        foreach($cart_item as $item)
        {
            $total_price += $item->product->selling_price * $item->prod_qty;
        }

        $firstName=$request->input('firstName');
        $lastName=$request->input('lastName');
        $email=$request->input('email');
        $phone=$request->input('phone');
        $address1=$request->input('address1');
        $address2=$request->input('address2');
        $city=$request->input('city');
        $state=$request->input('state');
        $country=$request->input('country');
        $pincode=$request->input('pincode');

         return response()->json([
            'firstName'=>$firstName,
            'lastName'=>$lastName,
            'email'=>$email,
            'phone'=>$phone,
            'address1'=>$address1,
            'address2'=>$address2,
            'city'=>$city,
            'state'=>$state,
            'country'=>$country,
            'pincode'=>$pincode,
            'total_price'=>$total_price
         ]);
    }

}
