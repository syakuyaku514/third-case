<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        return redirect('/login');
    }

}
