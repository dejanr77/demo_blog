<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class PagesController extends Controller
{
    public function __construct()
    {
        view()->share('currentUser', Auth::user());
    }

    public function home()
    {
        return view('public.home');
    }

    public function about()
    {
        return view('public.about');
    }


}
