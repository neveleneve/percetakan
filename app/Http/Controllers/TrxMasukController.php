<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TrxMasukController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::where('tipe_transaksi', 'masuk')->paginate(10);
        return view('pages.transaksi.masuk.index', [
            'transaksi' => $transaksi
        ]);
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
