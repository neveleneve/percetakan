<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        .header {
            padding: 20px;
            display: table;
            width: 100%;
        }

        .logo {
            display: inline-block;
            vertical-align: middle;
            width: 100px;
        }

        .logo img {
            max-width: 100%;
        }

        .company-name {
            display: inline-block;
            vertical-align: middle;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            margin-left: 20px;
            width: 736px;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- @include('pages.report.header') --}}
        <div class="header">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
            </div>
            <div class="company-name">
                Layon Desain Grafis
                <br>
                <h6 style="font-size: 22px; margin-bottom: 5px">
                    Jalan Ganet KM. 11 Perum. Bintan Permai Blok F5 No.7
                </h6>
                <h6 style="font-size: 18px">
                    Whatsapp : 0831-0293-1234
                </h6>
            </div>
        </div>
        <hr class="border border-success border-2">
        <div class="row justify-content-center">
            <div class="col-12">
                {{-- judul --}}
                @if ($tipe == 'item')
                    <h1 class="text-center fw-bold">Laporan Data Item</h1>
                @elseif ($tipe == 'gudang')
                    <h1 class="text-center fw-bold">Laporan Data Gudang</h1>
                @elseif ($tipe == 'masuk')
                    <h1 class="text-center fw-bold">Laporan Data Transaksi Masuk</h1>
                @elseif ($tipe == 'keluar')
                    <h1 class="text-center fw-bold">Laporan Data Transaksi Keluar</h1>
                @elseif ($tipe == 'transaksi_masuk')
                    <h1 class="text-center fw-bold">Invoice Transaksi</h1>
                @elseif ($tipe == 'transaksi_keluar')
                    <h1 class="text-center fw-bold">Invoice Transaksi</h1>
                @endif
            </div>
            <div class="col-12 mb-3 text-center">
                @foreach ($data as $transaction)
                    @if ($tipe == 'transaksi_masuk')
                        <label class="fw-bold" style="margin-bottom: 0px">Kode Transaksi</label>
                        <input type="text" class="form-control form-control-sm form-control-plaintext text-center"
                            value="{{ $transaction->kode_transaksi }}">
                        <label class="fw-bold" style="margin-bottom: 0px">Asal</label>
                        <input type="text" class="form-control form-control-sm form-control-plaintext text-center"
                            value="{{ $transaction->gudang->name }}">
                        <label class="fw-bold" style="margin-bottom: 0px">Penginput Data</label>
                        <input type="text" class="form-control form-control-sm form-control-plaintext text-center"
                            value="{{ $transaction->user->name }}">
                        <label class="fw-bold" style="margin-bottom: 0px">Tanggal Transaksi</label>
                        <input type="text" class="form-control form-control-sm form-control-plaintext text-center"
                            value="{{ date('d/m/Y H:i:s', strtotime($transaction->created_at)) }}">
                    @elseif ($tipe == 'transaksi_keluar')
                        <label class="fw-bold" style="margin-bottom: 0px">Kode Transaksi</label>
                        <input type="text" class="form-control form-control-sm form-control-plaintext text-center"
                            value="{{ $transaction->kode_transaksi }}">
                        <label class="fw-bold" style="margin-bottom: 0px">Total Transaksi</label>
                        <input type="text" class="form-control form-control-sm form-control-plaintext text-center"
                            value="Rp {{ number_format($transaction->total_transaksi, 0, ',', '.') }}">
                        <label class="fw-bold" style="margin-bottom: 0px">Penginput Data</label>
                        <input type="text" class="form-control form-control-sm form-control-plaintext text-center"
                            value="{{ $transaction->user->name }}">
                        <label class="fw-bold" style="margin-bottom: 0px">Tanggal Transaksi</label>
                        <input type="text" class="form-control form-control-sm form-control-plaintext text-center"
                            value="{{ date('d/m/Y H:i:s', strtotime($transaction->created_at)) }}">
                    @endif
                @endforeach
            </div>
            <div class="col-12">
                <table class="table">
                    <thead class="text-center fw-bold" style="color: #fff; background-color: #198754">
                        <tr>
                            @for ($i = 0; $i < count($table['head']); $i++)
                                <td>
                                    {{ $table['head'][$i] }}
                                </td>
                            @endfor
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if ($tipe == 'item')
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->stok }}</td>
                                </tr>
                            @endforeach
                        @elseif ($tipe == 'gudang')
                            @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <h2 class="fw-bold">
                                            Data Kosong
                                        </h2>
                                    </td>
                                </tr>
                            @endforelse
                        @elseif ($tipe == 'masuk')
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td>{{ $item->gudang->name }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <h2 class="fw-bold">
                                            Data Kosong
                                        </h2>
                                    </td>
                                </tr>
                            @endforelse
                        @elseif ($tipe == 'keluar')
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                                    <td>Rp {{ number_format($item->total_transaksi, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <h2 class="fw-bold">
                                            Data Kosong
                                        </h2>
                                    </td>
                                </tr>
                            @endforelse
                        @elseif ($tipe == 'transaksi_masuk')
                            @foreach ($data as $transaction)
                                @forelse ($transaction->detail as $detail)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $detail->item->name }}</td>
                                        <td>{{ $detail->item->satuan }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <h2 class="fw-bold">
                                                Data Kosong
                                            </h2>
                                        </td>
                                    </tr>
                                @endforelse
                            @endforeach
                        @elseif ($tipe == 'transaksi_keluar')
                            @foreach ($data as $transaction)
                                @forelse ($transaction->detail as $detail)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $detail->item->name }}</td>
                                        <td>{{ $detail->item->satuan }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                        <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                        <td class="text-end">Rp {{ number_format($detail->sub_total, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <h2 class="fw-bold">
                                                Data Kosong
                                            </h2>
                                        </td>
                                    </tr>
                                @endforelse
                            @endforeach
                        @endif
                    </tbody>
                    @if ($tipe == 'transaksi_keluar')
                        <tr>
                            <td colspan="5" class="fw-bold text-end">
                                Total
                            </td>
                            <td class="text-end">Rp
                                {{ number_format($data[0]->total_transaksi, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endif
                </table>
                Dikeluarkan pada {{ date('d/m/Y H:i:s') }}
            </div>
        </div>
    </div>
</body>

</html>
