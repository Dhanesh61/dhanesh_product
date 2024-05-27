<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        // dd("userr");
        return view('User');
    }

    public function laptop()
    {
        return view('product/laptop-detail');
    }

    public function watch()
    {
        return view('product/watch-detail');
    }

    public function phone()
    {
        return view('product/phone');
    }

    public function buy()
    {
        return view('product/buy-user');
    }
}
