<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index(User $user)
    {

        return view('users.profile', compact('user'));
    }

    public function show()
    {

    }

}