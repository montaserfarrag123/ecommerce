@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            
            <h3>User Details
                <a href="{{ url('users') }}" class="btn btn-primary float-end">Users</a>
            </h3>
            <hr>

            {{-- @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <h3>{{ session('status') }}</h3>
                </div>
            @endif --}}
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <label for="Name">Role</label>
                    <div class="p-2 border mb-2 ">{{ $user->role_as == '0' ? 'user' : 'Admin' }}</div>
                </div>
                <div class="col-md-4">
                    <label for="Name">First Name</label>
                    <div class="p-2 border mb-2 ">{{ $user->name }}</div>
                </div>
                <div class="col-md-4">
                    <label for="Name">Last Name</label>
                    <div class="p-2 border mb-2 ">{{ $user->lname }}</div>
                </div>
                <div class="col-md-4">
                    <label for="Name">Email</label>
                    <div class="p-2 border mb-2">{{ $user->email }}</div>
                </div>
                <div class="col-md-4">
                    <label for="Name">Phone</label>
                    <div class="p-2 border mb-2">{{ $user->phone }}</div>
                </div>
                <div class="col-md-4">
                    <label for="Name">Address1</label>
                    <div class="p-2 border mb-2">{{ $user->address1 }}</div>
                </div>
                <div class="col-md-4">
                    <label for="Name">Address2</label>
                    <div class="p-2 border mb-2">{{ $user->address2 }}</div>
                </div>
                <div class="col-md-4">
                    <label for="Name">City</label>
                    <div class="p-2 border mb-2">{{ $user->city }}</div>
                </div>
                <div class="col-md-4">
                    <label for="Name">State</label>
                    <div class="p-2 border mb-2">{{ $user->state }}</div>
                </div>
                <div class="col-md-4">
                    <label for="Name">Country</label>
                    <div class="p-2 border mb-2">{{ $user->country }}</div>
                </div>
                <div class="col-md-4">
                    <label for="Name">Pin Code</label>
                    <div class="p-2 border mb-2">{{ $user->pincode }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
