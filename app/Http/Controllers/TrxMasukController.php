<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TrxMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        $this->middleware('role:Admin')->only('create', 'store');
    }

    public function index()
    {
        $transaksi = Transaksi::with('gudang')->where('tipe_transaksi', 'masuk')->paginate(10);
        return view('pages.transaksi.masuk.index', [
            'transaksi' => $transaksi
        ]);
    }

    public function create()
    {
        $kode = $this->transactionCode(0);
        return view('pages.transaksi.masuk.create', [
            'kode' => $kode
        ]);
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'kode_transaksi' => ['required'],
            'tipe_transaksi' => ['required'],
            'kode_tipe_transaksi' => ['required'],
            'gudang' => ['required', 'numeric'],
            'selected' => ['required'],
            'id_item' => ['required'],
        ]);
        if ($validasi->fails()) {
            return redirect(route('masuk.create'))->with([
                'message' => 'Gagal menambahkan data transaksi. Silakan ulangi!',
                'color' => 'danger',
            ]);
        } else {
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
            $transaksi = Transaksi::create([
                'user_id' => Auth::user()->id,
                'kode_transaksi' => $request->kode_transaksi,
                'tipe_transaksi' => $request->kode_tipe_transaksi,
                'gudang_id' => $request->gudang,
            ]);
            for ($i = 0; $i < count($request->selected); $i++) {
                $item = Item::find($request->id_item[$i]);
                if ($request->selected[$i] > 0) {
                    $detail_trx = DetailTransaksi::create([
                        'transaksi_id' => $transaksi->id,
                        'item_id' => $request->id_item[$i],
                        'jumlah' => $request->selected[$i]
                    ]);
                    if ($detail_trx) {
                        $item->increment('stok', $request->selected[$i]);
                    }
                }
            }
            return redirect(route('transaksi.index'))->with([
                'message' => 'Berhasil menambahkan data transaksi masuk!',
                'color' => 'success',
            ]);
        }
    }
}
