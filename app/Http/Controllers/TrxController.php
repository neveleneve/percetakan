<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TrxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        $this->middleware('auth')->only('show');
        $this->middleware('role:Admin')->only('edit');
        $this->middleware('role:Admin')->only('destroy');
    }

    public function index()
    {
        $transaksi = Transaksi::paginate(10);
        return view('pages.transaksi.index', [
            'transaksi' => $transaksi
        ]);
    }

    public function show(Transaksi $transaksi)
    {
        return view('pages.transaksi.show', [
            'transaksi' => $transaksi
        ]);
    }

    public function edit(Transaksi $transaksi)
    {
        return view('pages.transaksi.edit', [
            'transaksi' => $transaksi
        ]);
    }

    public function destroy(Transaksi $transaksi)
    {
        dd($transaksi);
        // cek data untuk mengembalikan nilai item apakah dikurangi atau ditambah tergantung tipe transaksi
        // 
        // hapus data
        $transaksi->delete();
        return redirect(route('transaksi.index'))->with([
            'message' => 'Data transaksi berhasil dihapus!',
            'color' => 'success',
        ]);
    }
}
