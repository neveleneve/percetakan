<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin,Manager')->only('laporanBarangMasuk', 'laporanBarangKeluar', 'cetak');
        $this->middleware('role:Admin')->only('laporanDaftarGudang', 'laporanDaftarBarang');
    }

    public function laporanBarangMasuk()
    {
        // 
    }

    public function laporanBarangKeluar()
    {
        // 
    }

    public function laporanDaftarGudang()
    {
        // 
    }

    public function laporanDaftarBarang()
    {
        // 
    }

    public function cetak(Request $request)
    {
        // 
    }
}
