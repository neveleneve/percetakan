<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin,Manager')->only('laporanBarangMasuk', 'laporanBarangKeluar');
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
}
