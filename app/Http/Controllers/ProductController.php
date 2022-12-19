<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::orderBy('id','desc')->get();
        return view('admin.product.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = category::all();
        return view('admin.product.create' , compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'cate_id'=>'required',
            'name'=>'required',
            'slug'=>'required',
            'small_description'=>'required',
            'description'=>'required',
            'original_price'=>'required',
            'selling_price'=>'required',
            'tax'=>'required',
            'qty'=>'required',
            'meta_title'=>'required',
            'meta_keywords'=>'required',
            'meta_descrip'=>'required',
            'image'=>'mimes:jpg,bmp,png,pdf',
        ]);
        $products=new Product();
        if($request->hasFile('image')){
            $file = $request->image;
            $finalName = time() . rand() . $file->extension();
            $file->move(public_path('assets/product/') , $finalName);
            $products->image = $finalName;
        }
        $products->cate_id = $request->input('cate_id');
        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->small_description = $request->input('small_description');
        $products->description = $request->input('description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->tax = $request->input('tax');
        $products->qty = $request->input('qty');
        $products->status = $request->input('statuse')== true ?'1' : '0';
        $products->treding = $request->input('treding')== true ? '1' :'0';
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->meta_description = $request->input('meta_descrip');
        $products->save();
        return redirect(url('products'))->with('status','Product Aded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request , [
            'cate_id'=>'',
            'name'=>'required',
            'slug'=>'required',
            'small_description'=>'required',
            'description'=>'required',
            'original_price'=>'required',
            'selling_price'=>'required',
            'tax'=>'required',
            'qty'=>'required',
            'meta_title'=>'required',
            'meta_keywords'=>'required',
            'meta_descrip'=>'required',
            'image'=>'mimes:jpg,bmp,png,pdf',
        ]);
        $product = product::find($id);
        if($request->hasFile('image')){
            $path = public_path('assets/product/'.$product->image);
            if(File::exists($path)){
                File::delete($path);
                $finalName = time() . rand() .$request->image->extension();
                $request->image->move(public_path('assets/product/') , $finalName);
            }

        }else{
            $finalName = $product->image;
        }
        $data['image'] = $finalName;
        $data['treding'] =$request->input('treding')== true ? '1' :'0';
        $data['status'] =$request->input('statuse')== true ? '1' :'0';
       // $data['cate_id'] =$request->input('cate_id');

        product::find($id)->update($data);
        return redirect('products')->with('status','Product Updaed succssfully');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product , $id)
    {
        $categories = category::all();
        $products = product::find($id);
        return view('admin.product.edit' , compact('products' , 'categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::find($id);
        if($product->image){
            $path = public_path('assets/product/'.$product->image);
            if(File::exists($path)){
                File::delete($path);
            }

    }
      $product->delete();
      return redirect('products')->with('status','products Deleted succssfully');
    }
}
