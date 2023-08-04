<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrxKeluarController extends Controller
{
    public function index()
    {
        return view('pages.transaksi.keluar.index');
    }

    public function create()
    {
        return view('pages.transaksi.keluar.create');
    }

    public function store(Request $request)
    {
        return redirect(route('transaksi.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
