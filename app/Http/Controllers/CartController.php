<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addproduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check()){
            $prod_check = Product::where('id',$product_id)->first();
            if($prod_check){
                if(cart::where('prod_id',$product_id)->where('user_id',auth()->user()->id)->exists()){
                    return response()->json(['status'=>$prod_check->name.'is already add to cart']);
                }else{
                $cartItem = new cart();
                $cartItem->prod_id = $product_id;
                $cartItem->user_id = auth()->user()->id;
                $cartItem->prod_qty = $product_qty;
                $cartItem->save();
                return response()->json(['status'=>$prod_check->name.'Aded succssfully']);
              }
            }

        }else{
            return response()->json(['status' =>"login to continue"]);
        }

    }

    public function index(){

        $cartItem = cart::where('user_id',Auth::id())->get();
        return view('frontend.cart' , compact('cartItem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteproduct(Request $request)
    {
        if(Auth::check()){
        $prod_id = $request->input('prod_id');
        if(cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
            $cartItem = cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
            $cartItem->delete();
            return response()->json(['status' =>"Prodact deleted succefully"]);
        }
    }else{
        return response()->json(['status' =>"login to continue"]);
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cartUpdate(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $prod_qty = $request->input('prod_qty');
        if(Auth::check()){
            if(cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cart = cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cart->prod_qty = $prod_qty;
                $cart->update();
                return response()->json(['status'=>"Quantity Updated"]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function cartCount()
    {
        $cartCount = cart::where('user_id' , Auth::id())->count();
        return response()->json(['count'=> $cartCount]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cart)
    {
        //
    }
}
