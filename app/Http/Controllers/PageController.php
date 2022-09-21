<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Route To login page
     *
     * @return View login
     */
    public function login()
    {
        return view('pages.session.login');
    }

    public function dashboard()
    {
        return view('pages.session.home');
    }
}
