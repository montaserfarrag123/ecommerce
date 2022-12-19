@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Add Category</h1>
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
            <form action="{{ url('/storeCat') }}" method='POST' enctype="multipart/form-data">
                @csrf
                <div class="row">
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
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="statuse" class="form-label">Statuse</label>
                        <input type="checkbox" name="statuse" id="statuse">
                    </div>



                    <div class="col-md-6 mb-3">
                        <label for="popular" class="form-check-label">Popular</label>
                        <input type="checkbox" name="popular" id="popular">
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
