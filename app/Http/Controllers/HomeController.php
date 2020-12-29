<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(6);
        return view('home', compact('brands'));
    }
    public function privacy()
    {
        return view('privacy');
    }
    public function privacybm()
    {

        return view('privacybm');
    }

    public function terms()
    {

        return view('terms');
    }
}
