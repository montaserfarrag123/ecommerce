@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Edit Category</h1>
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
            <form action="{{ url('/updateCat/'.$categories->id) }}" method='POST' enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" value="{{$categories->name}}" name="name" class="form-control" id="name"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" value="{{$categories->slug}}" name="slug" class="form-control" id="slug">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description"  id="description" class="form-control" rows="3">{{$categories->description}}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="statuse" class="form-label">Statuse</label>
                        <input type="checkbox" {{$categories->statuse == "1" ? 'checked':''}} name="statuse" id="statuse">
                    </div>



                    <div class="col-md-6 mb-3">
                        <label for="popular" class="form-check-label">Popular</label>
                        <input type="checkbox" {{$categories->popular == "1" ? 'checked':''}} name="popular" id="popular">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" value="{{$categories->meta_title}}" name="meta_title" class="form-control" id="meta_title">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords" class="form-label">Meta keywords</label>
                        <textarea name="meta_keywords" id="meta_keywords" class="form-control" rows="3">{{$categories->meta_keywords}}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip" class="form-label">Meta Descrip</label>
                        <textarea name="meta_descrip" id="meta_descrip" class="form-control" rows="3">{{$categories->meta_descrip}}</textarea>
                    </div>

                    <div class="col-md-12 mb-2">
                        @if ($categories->image)
                        <img class="mb-2" src="{{asset('assets/category/'.$categories->image)}}" width='100'; height='100'; alt="" srcset="">
                        @endif
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>


                        <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </form>
        </div>
    </div>
@endsection
