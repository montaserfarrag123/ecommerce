<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class dashboardController extends Controller
{
    public function users()
    {
        $users = user::all();
        return view('admin.users.index' , compact('users'));
    }
    public function viewUser($id)
    {
        $user = user::find($id);
        return view('admin.users.view',compact('user'));
    }
}
