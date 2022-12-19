@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Add Product</h1>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="card-body">
            <form action="{{url('storeproduct')}}" method='POST' enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Ctaegory</label>
                        <select class="form-select" name="cate_id" aria-label="Default select example">

                            @foreach ($category as $item )
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" id="slug">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="small_description" class="form-label">Small Description</label>
                        <textarea name="small_description" id="small_description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="original_price" class="form-label">Original Price</label>
                        <input type="number" name="original_price" class="form-control" id="original_price">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="selling_price" class="form-label">Selling Price</label>
                        <input type="number" name="selling_price" class="form-control" id="selling_price">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tax" class="form-label">Tax</label>
                        <input type="number" name="tax" class="form-control" id="tax">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" name="qty" class="form-control" id="qty">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="statuse" class="form-label">Statuse</label>
                        <input type="checkbox" name="statuse" id="statuse">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="treding" class="form-check-label">Treding</label>
                        <input type="checkbox" name="treding" id="treding">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" id="meta_title">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords" class="form-label">Meta keywords</label>
                        <textarea name="meta_keywords" id="meta_keywords" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip" class="form-label">Meta Descrip</label>
                        <textarea name="meta_descrip" id="meta_descrip" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>


                        <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </form>
        </div>
    </div>
@endsection
