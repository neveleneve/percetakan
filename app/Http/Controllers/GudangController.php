<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GudangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        $this->middleware('auth')->only('show');
        $this->middleware('role:Admin')->only('edit', 'update');
        $this->middleware('role:Admin')->only('destroy');
        $this->middleware('role:Admin')->only('create', 'store');
    }

    public function index()
    {
        $gudang = Gudang::paginate(10);
        return view('pages.gudang.index', [
            'gudang' => $gudang
        ]);
    }

    public function create()
    {
        return view('pages.gudang.create');
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => ['required']
        ]);
        if ($validasi->fails()) {
            return redirect(route('gudang.create'))->with([
                'message' => 'Gagal menambah data gudang. Silakan ulangi!',
                'color' => 'danger',
            ]);
        } else {
            $gudang = Gudang::create([
                'name' => ucwords(strtolower($request->name))
            ]);
            if ($gudang) {
                return redirect(route('gudang.index'))->with([
                    'message' => 'Berhasil menambah data gudang!',
                    'color' => 'success',
                ]);
            } else {
                return redirect(route('gudang.create'))->with([
                    'message' => 'Gagal menambah data gudang. Silakan ulangi!',
                    'color' => 'danger',
                ]);
            }
        }
        return redirect(route('gudang.index'));
    }

    public function show(Gudang $gudang)
    {
        return view('pages.gudang.show', [
            'gudang' => $gudang
        ]);
    }

    public function edit(Gudang $gudang)
    {
        return view('pages.gudang.edit', [
            'gudang' => $gudang
        ]);
    }

    public function update(Request $request, Gudang $gudang)
    {
        $validasi = Validator::make($request->all(), [
            'name' => ['required']
        ]);
        if ($validasi->fails()) {
            return redirect(route('gudang.edit', ['gudang' => $gudang->id]))->with([
                'message' => 'Gagal mengubah data gudang. Silakan ulangi!',
                'color' => 'danger',
            ]);
        } else {
            $gudang->update([
                'name' => $request->name,
            ]);
            return redirect(route('gudang.edit', ['gudang' => $gudang->id]))->with([
                'message' => 'Berhasil mengubah data gudang!',
                'color' => 'success',
            ]);
        }
    }

    public function destroy(Gudang $gudang)
    {
        $gudang->delete();
        return redirect(route('gudang.index'))->with([
            'message' => 'Berhasil menghapus data gudang : ' . $gudang->name . '!',
            'color' => 'success',
        ]);
    }
}
