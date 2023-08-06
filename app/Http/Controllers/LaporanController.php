<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'type' => 'required'
        ]);
        if ($validator->fails()) {
            # code...
        } else {
            $tipe = $request->type;
            if ($tipe == 'masuk') {
                # code...
            } else if ($tipe == 'keluar') {
                # code...
            } else if ($tipe == 'barang') {
                # code...
            } else if ($tipe == 'gudang') {
                # code...
            }
        }
    }
}
