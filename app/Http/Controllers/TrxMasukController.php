<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrxMasukController extends Controller
{
    public function index()
    {
        return view('pages.transaksi.masuk.index');
    }

    public function create()
    {
        return view('pages.transaksi.masuk.create');
    }

    public function store(Request $request)
    {
        return redirect(route('transaksi.index'));
    }

    public function show($id)
    {
        // no route
    }

    public function edit($id)
    {
        // no route
    }

    public function update(Request $request, $id)
    {
        // no route
    }

    public function destroy($id)
    {
        // no route
    }
}
