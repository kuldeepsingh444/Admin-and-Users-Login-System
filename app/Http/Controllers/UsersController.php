<?php

namespace App\Http\Controllers;

class UsersController extends Controller
{
    public function userdashboard()
    {
        return view('user.dashboard');
    }
}
