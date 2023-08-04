<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        $this->middleware('auth')->only('show');
        $this->middleware('role:Admin')->only('edit', 'update');
        $this->middleware('role:Admin')->only('destroy');
        $this->middleware('role:Admin')->only('create', 'store');
    }

    public function index()
    {
        return view('pages.transaksi.index');
    }

    public function create()
    {
        // no route
    }

    public function store(Request $request)
    {
        // no route
    }

    public function show($id)
    {
        return view('pages.transaksi.show');
    }

    public function edit($id)
    {
        return view('pages.transaksi.edit');
    }

    public function update(Request $request, $id)
    {
        // no route
    }

    public function destroy($id)
    {
        return redirect(route('transaksi.index'));
    }
}
