<?php

namespace App\Http\Controllers;


class GuestController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.home',['pageName'=>'home']);
    }


    /**
     * Show the application static pages
     *
     * about| contact-us | terms | conditions | etc.
     *
     * @param $staticPages
     *
     * @return void
     */

     public function showStaticPages($staticPage){

        return view('frontend.static-pages.'.$staticPage,['pageName'=>$staticPage]);
     }
}
