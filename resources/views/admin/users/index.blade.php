@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{url('createproduct')}}" class="btn btn-primary">Register Users</a>
            <h3>Users Page</h3>
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
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $user->name .' '. $user->lname}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->phone}}</td>
w

                    <td>
                        <a href="{{ url('view-user/'.$user->id) }}" class="btn btn-primary">view</a>
                        {{-- <a href="#" class="btn btn-danger">Delete</a> --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}">
                            Delete
                        </button>
                    </td>
                    </tr>
                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('deleteproduct/'.$user->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <h4>Do You Want Delete a . <span class="text-danger">{{$user->name}}</span></h4>
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
