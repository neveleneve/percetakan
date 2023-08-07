@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.sidebar')
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title fw-bold text-center">Data Gudang</h3>
                        <hr>
                        @if (session()->has('message'))
                            <div class="alert alert-{{ session('color') }} alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (Auth::user()->role->name == 'Admin')
                            <div class="row">
                                <div class="col-12 col-lg">
                                    <div class="d-grid gap-2 mb-3">
                                        <a href="{{ route('gudang.create') }}"
                                            class="btn btn-sm btn-outline-success fw-bold">
                                            Tambah Data Gudang
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-lg">
                                    <div class="d-grid gap-2 mb-3">
                                        <a href="{{ route('laporan.gudang') }}"
                                            class="btn btn-sm btn-outline-danger fw-bold">
                                            Laporan Data Gudang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-nowrap">
                                <thead class="table-success">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($gudang as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <a href="{{ route('gudang.show', ['gudang' => $item->id]) }}"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if (Auth::user()->role->name == 'Admin')
                                                    <a href="{{ route('gudang.edit', ['gudang' => $item->id]) }}"
                                                        class="btn btn-sm btn-outline-danger">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">
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
        </div>
        <div class="row justify-content-center mt-3">
            {{ $gudang->links('layouts.paginate') }}
        </div>
    </div>
@endsection
