@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.sidebar')
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header text-bg-success">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-light">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <span class="fw-bold">
                            Lihat Data Transaksi
                        </span>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-{{ session('color') }} alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label class="fw-bold mb-2">Kode Transaksi</label>
                                <p>
                                    {{ $transaksi->kode_transaksi }}
                                </p>
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label class="fw-bold mb-2">Tipe Transaksi</label>
                                <p>
                                    Transaksi {{ ucwords($transaksi->tipe_transaksi) }}
                                </p>
                            </div>
                            @if ($transaksi->tipe_transaksi == 'keluar')
                                <div class="col-12 col-lg-10 text-center mb-3">
                                    <label class="fw-bold mb-2">Total Transaksi</label>
                                    <p>
                                        Rp {{ number_format($transaksi->total_transaksi, 0, ',', '.') }}
                                    </p>
                                </div>
                            @endif
                            @if ($transaksi->tipe_transaksi == 'masuk')
                                <div class="col-12 col-lg-10 text-center mb-3">
                                    <label class="fw-bold mb-2">Asal Gudang</label>
                                    <p>
                                        {{ $transaksi->gudang->name }}
                                    </p>
                                </div>
                            @endif
                            <div class="col-12 col-lg-10 text-center">
                                <label class="fw-bold mb-2">Penginput Data</label>
                                <p>
                                    {{ $transaksi->user->name }}
                                </p>
                                <hr>
                            </div>
                            <h4 class="fw-bold text-center mb-3">Detail Transaksi</h4>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <div class="table-container">
                                    <table class="table table-bordered">
                                        <thead class="fw-bold text-center table-success">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Item</th>
                                                <th>Jumlah</th>
                                                @if ($transaksi->tipe_transaksi == 'keluar')
                                                    <th>Harga</th>
                                                    <th>Subtotal</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaksi->detail as $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $item->item->name }}</td>
                                                    <td>{{ $item->jumlah }}</td>
                                                    @if ($transaksi->tipe_transaksi == 'keluar')
                                                        <td>Rp
                                                            {{ number_format($item->harga, 0, ',', '.') }}
                                                        </td>
                                                        <td>Rp
                                                            {{ number_format($item->sub_total, 0, ',', '.') }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @if ($transaksi->tipe_transaksi == 'keluar')
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">
                                                        Total
                                                    </td>
                                                    <td>
                                                        Rp {{ number_format($transaksi->total_transaksi, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-style')
    <style>
        .table-container {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
@endpush
