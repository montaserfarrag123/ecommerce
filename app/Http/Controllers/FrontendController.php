<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;

class FrontendController extends Controller
{
    //admin
    public function index()
    {
        return view('admin.index');
    }

     //user
    public function frontend()
    {
        $featuresProduct  = Product::where('treding','1')->take(15)->get();
        $trindengCategory = Category::where('popular','1')->take(15)->get();
        return view('frontend.index' , compact('featuresProduct' , 'trindengCategory'));
    }
    public function category()
    {
        $category = category::where('statuse','0')->get();
        return view('frontend.category' , compact('category'));
    }
    public function viewCategory($slug){
            if(category::where('slug' , $slug)->exists()){
                $category = category::where('slug' ,$slug)->first();
                $product = product::where('cate_id' , $category->id)->get();
                return view('frontend.product.index', compact( 'category' , 'product'));

            }else{
                return redirect('dashboard')->with('status','Not Found Category');
            }
    }
    public function viewproduct($cat_slug , $prod_slug){

        if(category::where('slug' , $cat_slug)->exists()){
            if(product::where('slug',$prod_slug)->exists()){
              $products = product::where('slug',$prod_slug)->first();
              return view('frontend.product.view', compact('products'));
            }else{
                return redirect('/')->with('status','The Link Was Broken');
            }
        }else{
            return redirect('/')->with('status','No Such Catgeory Found');
        }
    }
}
