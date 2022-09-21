<?php

namespace App\Http\Controllers;

use App\Models\Data\Kategori;
use App\Models\Data\Parfum;
use App\Models\Data\Pelanggan;
use App\Models\Data\Pengeluaran;
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
        return view(
            'pages.data.Kategori',
            ['data' => Kategori::paginate(5)]
        );
    }

    public function parfum()
    {
        return view(
            'pages.data.Parfum',
            ['data' => Parfum::paginate(5)]
        );
    }

    public function pelanggan()
    {
        return view(
            'pages.data.Pelanggan',
            ['data' => Pelanggan::paginate(5)]
        );
    }

    public function pengeluaran()
    {
        return view(
            'pages.data.Pengeluaran',
            ['data' => Pengeluaran::paginate(5)]
        );
    }

    public function rewash()
    {
        return view(
            'pages.data.Rewash'
        );
    }
}
