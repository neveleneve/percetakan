<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrxKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        $this->middleware('role:Admin,User')->only('create', 'store');
    }

    public function index()
    {
        $transaksi = Transaksi::where('tipe_transaksi', 'keluar')->paginate(10);
        return view('pages.transaksi.keluar.index', [
            'transaksi' => $transaksi
        ]);
    }

    public function create()
    {
        $kode = $this->transactionCode(1);
        return view('pages.transaksi.keluar.create', [
            'kode' => $kode
        ]);
    }

    public function store(Request $request)
    {
        $total = 0;
        for ($i = 0; $i < count($request->selected); $i++) {
            $total += $request->selected[$i];
        }
        if ($total == 0) {
            return redirect(route('masuk.create'))->with([
                'message' => 'Gagal menambahkan data transaksi. Silakan ulangi!',
                'color' => 'danger',
            ]);
        }

        // dd($request->all());
        $transaksi = Transaksi::create([
            'user_id' => Auth::user()->id,
            'kode_transaksi' => $request->kode_transaksi,
            'tipe_transaksi' => $request->kode_tipe_transaksi,
        ]);
        for ($i = 0; $i < count($request->selected); $i++) {
            $item = Item::find($request->id_item[$i]);
            if ($request->selected[$i] > 0) {
                $harga = $item->harga;
                $sub_total = $harga * $request->selected[$i];
                $detail_trx = DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'item_id' => $request->id_item[$i],
                    'jumlah' => $request->selected[$i],
                    'harga' => $harga,
                    'sub_total' => $sub_total,
                ]);
                if ($detail_trx) {
                    $item->decrement('stok', $request->selected[$i]);
                    $transaksi->increment('total_transaksi', $sub_total);
                }
            }
        }
        return redirect(route('transaksi.index'))->with([
            'message' => 'Berhasil menambahkan data transaksi keluar!',
            'color' => 'success',
        ]);
    }
}
