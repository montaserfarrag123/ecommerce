@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{url('createproduct')}}" class="btn btn-primary">Add Product</a>
            <h3>Product Page</h3>
            {{-- @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <h3>{{ session('status') }}</h3>
                </div>
            @endif --}}
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Original Price</th>
                        <th scope="col">Selling</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($products as $item)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $item->category->name}}</td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->description}}</td>
                            <td>{{ $item->original_price}}</td>
                            <td>{{ $item->selling_price}}</td>

                            <td>
                                @if ($item->image)
                                    <img src="{{ asset('assets/product/' . $item->image) }}" width=50; height=50;
                                        srcset="">
                            </td>
                        @else
                            {{ 'لم يتم ارفاق الصورة ' }}
                    @endif
                    <td>
                        <a href="editproduct/{{ $item->id }}" class="btn btn-primary">Edit</a>
                        {{-- <a href="#" class="btn btn-danger">Delete</a> --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                            Delete
                        </button>
                    </td>
                    </tr>
                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('deleteproduct/'.$item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <h4>Do You Want Delete a . <span class="text-danger">{{$item->name}}</span></h4>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
