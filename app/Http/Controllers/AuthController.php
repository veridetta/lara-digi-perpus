<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(){
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }else if(Auth::user()->role == 'user'){
                return redirect()->route('user.dashboard');
            }
        }else{
            return redirect()->route('login');
        }
    }
}
