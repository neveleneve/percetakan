<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index', 'show');
        $this->middleware('role:Admin')->only('edit', 'update', 'destroy', 'create', 'store');
    }

    public function index()
    {
        $item = Item::paginate(10);
        return view('pages.item.index', [
            'items' => $item
        ]);
    }

    public function create()
    {
        return view('pages.item.create');
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => ['required'],
            'satuan' => ['required'],
            'harga' => ['required', 'numeric']
        ]);
        if ($validasi->fails()) {
            return redirect(route('item.create'))->with([
                'message' => 'Gagal menambah data item. Silakan ulangi!',
                'color' => 'danger',
            ]);
        } else {
            $item = Item::create([
                'name' => ucwords(strtolower($request->name)),
                'satuan' => ucwords(strtolower($request->satuan))
            ]);
            if ($item) {
                return redirect(route('item.index'))->with([
                    'message' => 'Berhasil menambah data item!',
                    'color' => 'success',
                ]);
            } else {
                return redirect(route('item.create'))->with([
                    'message' => 'Gagal menambah data item. Silakan ulangi!',
                    'color' => 'danger',
                ]);
            }
        }
        return redirect(route('item.index'));
    }

    public function show(Item $item)
    {
        return view('pages.item.show', [
            'item' => $item
        ]);
    }

    public function edit(Item $item)
    {
        return view('pages.item.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, Item $item)
    {
        $validasi = Validator::make($request->all(), [
            'name' => ['required'],
            'satuan' => ['required'],
            'harga' => ['required', 'numeric'],
        ]);
        if ($validasi->fails()) {
            return redirect(route('item.edit', ['item' => $item->id]))->with([
                'message' => 'Gagal mengubah data item. Silakan ulangi!',
                'color' => 'danger',
            ]);
        } else {
            $item->update([
                'name' => $request->name,
                'satuan' => $request->satuan,
            ]);
            return redirect(route('item.edit', ['item' => $item->id]))->with([
                'message' => 'Berhasil mengubah data item!',
                'color' => 'success',
            ]);
        }
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect(route('item.index'))->with([
            'message' => 'Berhasil menghapus data item : ' . $item->name . '!',
            'color' => 'success',
        ]);
    }
}
