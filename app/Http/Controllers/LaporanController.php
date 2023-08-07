<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Item;
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
        $datareport = [
            'nama' => 'Transaksi Masuk',
            'tipe' => 'masuk'
        ];
        return view('pages.report.transaksi-masuk', [
            'data' => $datareport
        ]);
    }

    public function laporanBarangKeluar()
    {
        $datareport = [
            'nama' => 'Transaksi Keluar',
            'tipe' => 'keluar'
        ];
        return view('pages.report.transaksi-keluar', [
            'data' => $datareport
        ]);
    }

    public function laporanDaftarGudang()
    {
        $datareport = [
            'nama' => 'Gudang',
            'tipe' => 'gudang'
        ];
        return view('pages.report.gudang', [
            'data' => $datareport
        ]);
    }

    public function laporanDaftarBarang()
    {
        $datareport = [
            'nama' => 'Item',
            'tipe' => 'item'
        ];
        return view('pages.report.item', [
            'data' => $datareport
        ]);
    }

    public function cetak(Request $request)
    {
        $rules = [];
        if ($request->jenis == 'harian') {
            $rules = [
                'type' => ['required'],
                'tanggal' => ['required', 'date'],
            ];
        } elseif ($request->jenis == 'bulanan') {
            $rules = [
                'type' => ['required'],
                'bulan' => ['required']
            ];
        } elseif ($request->jenis == 'tahunan') {
            $rules = [
                'type' => ['required'],
                'tahun' => ['required', 'numeric']
            ];
        } elseif ($request->jenis == 'tanggal') {
            $rules = [
                'type' => ['required'],
                'dari' => ['required', 'lt:sampai'],
                'sampai' => ['required', 'gt:dari'],
            ];
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->with([
                'message' => 'Gagal menampilkan laporan. Silakan ulangi!',
                'color' => 'danger'
            ]);
        } else {
            $tipe = $request->type;
            if ($tipe == 'masuk') {
                $table = [
                    'head' => ['No', 'Kode Transaksi', 'Asal']
                ];
            } else if ($tipe == 'keluar') {
                $table = [
                    'head' => ['No', 'Nama', 'Satuan', 'Harga', 'Stok']
                ];
            } else if ($tipe == 'barang') {
                $table = [
                    'head' => ['No', 'Nama', 'Satuan', 'Harga', 'Stok']
                ];
                $item = Item::get();
            } else if ($tipe == 'gudang') {
                $table = [
                    'head' => ['No', 'Nama']
                ];
                $item = Gudang::get();
            }
        }
    }
}
