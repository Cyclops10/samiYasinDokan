<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->hasAnyRole('admin'))
            return redirect('admin/dashboard');
        else if($user->hasAnyRole('seller'))
            return redirect('seller/dashboard');
        else
            return redirect('user/dashboard');
    }

    public function fake()
    {
        return view('admin.dashboard');
    }
}
