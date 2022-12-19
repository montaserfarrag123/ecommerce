<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class wishlistController extends Controller
{
    public function index()
    {
        $wishlist = wishlist::where('user_id' , Auth::id())->get();
        return view('frontend.wishlist' , compact('wishlist'));
    }

    public function add(Request $request)
    {

        if(Auth::check()){
            $prod_id = $request->input('product_id');
            if(product::find($prod_id)){
                $wish = new wishlist();
                $wish->prod_id = $prod_id;
                $wish->user_id = Auth::id();
                $wish->save();
                return response()->json(['status' => 'Product Aded To Wishlist Successfully']);
            }else{
                return response()->json(['status' => 'Product Dos not in Wishlist ']);
            }
        }else{
             return response()->json(['status' => 'Login To Continuo']);
        }
    }

    public function destroy(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $Wishlist = Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $Wishlist->delete();
                return response()->json(['status' =>"Wishlist deleted succefully"]);
            }
        }else{
            return response()->json(['status' =>"login to continue"]);
        }
    }
    public function wishlistCount()
    {
        $wishlistCount = wishlist::where('user_id' , Auth::id())->count();
        return response()->json(['count'=> $wishlistCount]);

    }
    }
