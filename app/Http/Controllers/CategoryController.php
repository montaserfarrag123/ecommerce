<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $categories = category::orderBy('id','DESC')->get();
        return view('admin.category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' =>'required',
            'slug' =>'required',
            'description' =>'required',
            'meta_title' =>'required',
            'meta_keywords' =>'required',
            'meta_descrip' =>'required',
        ]);
        $category = new category();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $finalName = time() . rand() . '.' . $request->image->extension();
            $file->move(public_path('assets/category') , $finalName);
            $category->image = $finalName;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->statuse = $request->input('statuse') == true ?'1' : '0';
        $category->popular = $request->input('popular') == true ?'1' : '0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');
        $category->save();
        return redirect(url('categories'))->with('status','Category Aded Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category , $id)
    {
        $categories = category::find($id);
        return view('admin.category.edit' , compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $data = $this->validate($request , [
            'name' =>'required',
            'slug' =>'required',
            'description' =>'required',
            'meta_title' =>'required',
            'meta_keywords' =>'required',
            'meta_descrip' =>'required',
        ]);
        // $category=category::find($id);
        // if($request->hasFile('image')){

        //     $finalName = time() . rand().$request->image->extension();
        //   if($request->image->move(public_path('assets/category/') , $finalName)){

        //     unlink(public_path('assets/category/'.$category->image));
        //   }
        // } else{
        //     $finalName = $category->image ;
        // }
        // $data['image'] = $finalName;
        // category::find($id)->update($data);
        // return redirect('categories');

        //===========in inother way==========

        $category=category::find($id);
        if($request->hasfile('image')){
            $path = public_path(asset('assets/category/'.$category->image));
            if(File::exists($path)){
                File::delete($path);
            }
            $finalName = time() . rand() . $request->image->extension();
            $request->image->move(public_path('assets/category/'), $finalName);
        }else{
           $finalName = $category->image;
        }
        $data['image'] = $finalName;
        $data['popular'] =$request->input('popular')== true ? '1' :'0';
        $data['statuse'] =$request->input('statuse')== true ? '1' :'0';
        category::find($id)->update($data);
        return redirect('categories')->with('status','Category Updaed succssfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $category = category::find($id);
        if($category->image){
            $path = public_path('assets/category/'.$category->image);
            if(File::exists($path)){
                File::delete($path);
            }

        }
        $category->delete();
        return redirect('categories')->with('status','Category Deleted succssfully');
    }

}
