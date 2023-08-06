@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.sidebar')
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title fw-bold text-center">Data Transaksi</h3>
                        <hr>
                        @if (session()->has('message'))
                            <div class="alert alert-{{ session('color') }} alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @include('layouts.transaksi')
                        <div class="row">
                            @if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'User')
                                <div class="col-12 col-lg">
                                    <div class="d-grid gap-2 mb-3">
                                        <button class="btn btn-sm btn-outline-success fw-bold" data-bs-toggle="modal"
                                            data-bs-target="#modalLaporan">
                                            Tambah Transaksi
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalLaporan">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">Tambah Transaksi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-grid gap-2">
                                                    @if (Auth::user()->role->name == 'Admin')
                                                        <a href="{{ route('masuk.create') }}"
                                                            class="btn btn-sm btn-outline-success fw-bold">
                                                            Tambah Transaksi Masuk
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('keluar.create') }}"
                                                        class="btn btn-sm btn-outline-danger fw-bold">
                                                        Tambah Transaksi Keluar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Manager')
                                <div class="col-12 col-lg">
                                    <div class="d-grid gap-2 mb-3">
                                        <button class="btn btn-sm btn-outline-danger fw-bold" data-bs-toggle="modal"
                                            data-bs-target="#modalTransaksi">
                                            Laporan Transaksi
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalTransaksi">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">Laporan Transaksi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-grid gap-2">
                                                    <a href="{{ route('masuk.create') }}"
                                                        class="btn btn-sm btn-outline-success fw-bold">
                                                        Laporan Transaksi Masuk
                                                    </a>
                                                    <a href="{{ route('keluar.create') }}"
                                                        class="btn btn-sm btn-outline-danger fw-bold">
                                                        Laporan Transaksi Keluar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <table class="table table-bordered text-center">
                            <thead class="table-success">
                                <tr>
                                    <th>#</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tipe Transaksi</th>
                                    <th>Total Transaksi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->kode_transaksi }}</td>
                                        <td>{{ ucwords($item->tipe_transaksi) }}</td>
                                        <td>
                                            {{ $item->total_transaksi != 0 ? 'Rp ' . number_format($item->total_transaksi, 0, ',', '.') : '-' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('transaksi.show', ['transaksi' => $item->id]) }}"
                                                class="btn btn-sm btn-outline-success">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if (Auth::user()->role->name == 'Admin')
                                                <a href="{{ route('item.edit', ['item' => $item->id]) }}"
                                                    class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <h6 class="fw-bold text-center h4">Data Kosong</h6>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            {{ $transaksi->links('layouts.paginate') }}
        </div>
    </div>
@endsection
