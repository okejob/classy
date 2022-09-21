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

    /**
     * Reset Password Page
     *
     * @return View reset password
     */
    public function resetPassword()
    {
        return view('pages.session.ubahPassword');
    }

    public function dashboard()
    {
        return view('pages.session.home');
    }

    public function item()
    {
        return view('pages.data.Item');
    }

    public function kategori()
    {
        return view('pages.data.Kategori');
    }

    public function parfum()
    {
        return view('pages.data.Parfum');
    }

    public function pelanggan()
    {
        return view('pages.data.Pelanggan');
    }

    public function pengeluaran()
    {
        return view('pages.data.Pengeluaran');
    }

    public function rewash()
    {
        return view('pages.data.Rewash');
    }
}
