<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TrxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index', 'show');
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
        $lastTransaction = Transaksi::latest('id')->first();
        return view('pages.transaksi.show', [
            'transaksi' => $transaksi,
            'last_id' => $lastTransaction,
        ]);
    }

    public function destroy(Request $request, Transaksi $transaksi)
    {
        if ($request->tipe_transaksi == 'masuk') {
            $jumlah = count($transaksi->detail);
            for ($i = 0; $i < $jumlah; $i++) {
                Item::find($transaksi->detail[$i]->item_id)->decrement('stok', $transaksi->detail[$i]->jumlah);
            }
        } elseif ($request->tipe_transaksi == 'keluar') {
            $jumlah = count($transaksi->detail);
            for ($i = 0; $i < $jumlah; $i++) {
                Item::find($transaksi->detail[$i]->item_id)->increment('stok', $transaksi->detail[$i]->jumlah);
            }
        }

        DetailTransaksi::where('transaksi_id', $transaksi->id)->delete();
        $transaksi->delete();
        return redirect(route('transaksi.index'))->with([
            'message' => 'Data transaksi berhasil dihapus!',
            'color' => 'success',
        ]);
    }
}
