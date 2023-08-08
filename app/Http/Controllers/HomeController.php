<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    public function index()
    {
        // $masuk = Transaksi::where('tipe_transaksi', 'masuk')->count();
        // $keluar = Transaksi::where('tipe_transaksi', 'keluar')->count();
        $masuk = Transaksi::where('tipe_transaksi', 'masuk')
            ->whereDate('created_at', date('Y-m-d'))->count();
        $keluar = Transaksi::where('tipe_transaksi', 'keluar')
            ->whereDate('created_at', date('Y-m-d'))->count();
        $totalkeluar = Transaksi::where('tipe_transaksi', 'keluar')->whereDate('created_at', date('Y-m-d'))->sum('total_transaksi');
        // dd($totalkeluar);
        return view('home', [
            'masuk' => $masuk,
            'keluar' => $keluar,
            'totalkeluar' => $totalkeluar,
        ]);
    }
}
