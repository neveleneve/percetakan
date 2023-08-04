<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        // $this->middleware('auth')->only('show');
        // $this->middleware('role:Admin')->only('edit', 'update');
        // $this->middleware('role:Admin')->only('destroy');
        // $this->middleware('role:Admin')->only('create', 'store');
    }

    public function index()
    {
        return view('home');
    }
}
