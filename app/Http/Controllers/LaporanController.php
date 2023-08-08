<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

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
        // dd($request->all());
        $rules = [];
        if ($request->jenis == 'harian') {
            $rules = [
                'type' => ['required'],
                'tanggal' => ['required', 'date'],
            ];
        } else if ($request->jenis == 'bulanan') {
            $rules = [
                'type' => ['required'],
                'bulan' => ['required']
            ];
        } else if ($request->jenis == 'tahunan') {
            $rules = [
                'type' => ['required'],
                'tahun' => ['required', 'numeric']
            ];
        } else if ($request->jenis == 'tanggal') {
            $rules = [
                'type' => ['required'],
                'dari' => ['required',],
                'sampai' => ['required',],
            ];
        } else if ($request->jenis == 'masuk' || $request->jenis == 'keluar') {
            $rules = [
                'type' => ['required'],
                'id_transaksi' => ['required', 'numeric'],
            ];
        }

        // dd($request->all());

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'message' => 'Gagal menampilkan laporan. Silakan ulangi!',
                'color' => 'danger'
            ]);
        } else {
            $tipe = $request->type;
            if ($tipe == 'masuk') {
                $option = [
                    'paper' => 'A4',
                    'orientation' => null,
                ];
                $table = [
                    'head' => ['No', 'Kode Transaksi', 'Asal', 'Tanggal Transaksi']
                ];
                if ($request->jenis == 'harian') {
                    $data = Transaksi::where('tipe_transaksi', $tipe)
                        ->whereDate('created_at', $request->tanggal)
                        ->get();
                } else if ($request->jenis == 'bulanan') {
                    $data = Transaksi::where('tipe_transaksi', $tipe)
                        ->whereMonth('created_at', date('m', strtotime($request->bulan)))
                        ->whereYear('created_at', date('Y', strtotime($request->bulan)))
                        ->get();
                } else if ($request->jenis == 'tahunan') {
                    $data = Transaksi::where('tipe_transaksi', $tipe)
                        ->whereYear('created_at', date('Y', strtotime($request->tahun)))
                        ->get();
                } else if ($request->jenis == 'tanggal') {
                    $dari = $request->dari . ' 00:00:00';
                    $sampai = $request->sampai . ' 23:59:59';
                    $data = Transaksi::where('tipe_transaksi', $tipe)
                        ->whereBetween('created_at', [$dari, $sampai])
                        ->get();
                }
            } else if ($tipe == 'keluar') {
                $option = [
                    'paper' => 'A4',
                    'orientation' => null,
                ];
                $table = [
                    'head' => ['No', 'Kode Transaksi', 'Tanggal Transaksi', 'Total']
                ];
                if ($request->jenis == 'harian') {
                    $data = Transaksi::where('tipe_transaksi', $tipe)
                        ->whereDate('created_at', $request->tanggal)
                        ->get();
                } else if ($request->jenis == 'bulanan') {
                    $data = Transaksi::where('tipe_transaksi', $tipe)
                        ->whereMonth('created_at', date('m', strtotime($request->bulan)))
                        ->whereYear('created_at', date('Y', strtotime($request->bulan)))
                        ->get();
                } else if ($request->jenis == 'tahunan') {
                    $data = Transaksi::where('tipe_transaksi', $tipe)
                        ->whereYear('created_at', date('Y', strtotime($request->tahun)))
                        ->get();
                } else if ($request->jenis == 'tanggal') {
                    $dari = $request->dari . ' 00:00:00';
                    $sampai = $request->sampai . ' 23:59:59';
                    $data = Transaksi::where('tipe_transaksi', $tipe)
                        ->whereBetween('created_at', [$dari, $sampai])
                        ->get();
                }
            } else if ($tipe == 'item') {
                // tidak pakai if waktu
                $option = [
                    'paper' => 'A4',
                    'orientation' => null,
                ];
                $table = [
                    'head' => ['No', 'Nama', 'Satuan', 'Harga', 'Stok']
                ];
                $data = Item::get();
            } else if ($tipe == 'gudang') {
                $option = [
                    'paper' => 'A4',
                    'orientation' => null,
                ];
                // tidak pakai if waktu
                $table = [
                    'head' => ['No', 'Nama']
                ];
                $data = Gudang::get();
            } else if ($tipe == 'transaksi_masuk' || $tipe == 'transaksi_keluar') {
                // tidak pakai if waktu
                $option = [
                    'paper' => 'A5',
                    'orientation' => 'landscape',
                ];
                if ($tipe == 'transaksi_masuk') {
                    $table = [
                        'head' => ['No', 'Nama Item', 'Satuan', 'Jumlah']
                    ];
                } else if ($tipe == 'transaksi_keluar') {
                    $table = [
                        'head' => ['No', 'Nama Item', 'Satuan', 'Jumlah', 'Harga', 'Sub Total']
                    ];
                }
                $data = Transaksi::with([
                    'user',
                    'gudang',
                    'detail',
                    'detail.item'
                ])
                    ->where('id', $request->id_transaksi)
                    ->get();
            }
        }

        $pdf = PDF::loadView('pages.report.cetak', [
            'table' => $table,
            'data' => $data,
            'tipe' => $tipe,
        ]);
        $pdf->setPaper($option['paper']);
        $pdf->setOrientation($option['orientation']);

        return $pdf->stream('laporan.pdf');
    }
}
