<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $item = Item::get();
        $total = 0;
        for ($i = 0; $i < count($item); $i++) {
            $total += $item[$i]->stok;
        }
        if ($total != 0) {
            $kode = $this->transactionCode(1);
            return view('pages.transaksi.keluar.create', [
                'kode' => $kode
            ]);
        } else {
            return redirect(route('keluar.index'))->with([
                'message' => 'Tidak bisa melakukan transaksi karena data barang tidak tersedia. Silakan ulangi!',
                'color' => 'danger',
            ]);
        }
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'kode_transaksi' => ['required'],
            'tipe_transaksi' => ['required'],
            'kode_tipe_transaksi' => ['required'],
            'selected' => ['required'],
            'id_item' => ['required'],
        ]);

        if ($validasi->fails()) {
            return redirect(route('keluar.create'))->with([
                'message' => 'Gagal menambahkan data transaksi. Silakan ulangi!',
                'color' => 'danger',
            ]);
        } else {
            $total = 0;
            for ($i = 0; $i < count($request->selected); $i++) {
                $total += $request->selected[$i];
            }
            if ($total == 0) {
                return redirect(route('keluar.create'))->with([
                    'message' => 'Gagal menambahkan data transaksi. Silakan ulangi!',
                    'color' => 'danger',
                ]);
            }
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
}
