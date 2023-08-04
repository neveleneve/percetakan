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
                            <div class="d-grid gap-2 mb-3">
                                <a href="{{ route('gudang.create') }}" class="btn btn-sm btn-outline-success fw-bold">
                                    Tambah Gudang
                                </a>
                            </div>
                        @endif
                        <table class="table table-bordered text-center">
                            <thead class="table-success">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    @if (Auth::user()->role->name == 'Admin')
                                        <th></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gudang as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        @if (Auth::user()->role->name == 'Admin')
                                            <td>
                                                <a href="{{ route('gudang.show', ['gudang' => $item->id]) }}"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('gudang.edit', ['gudang' => $item->id]) }}"
                                                    class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        @if (Auth::user()->role->name == 'Admin')
                                            <td colspan="3">
                                                <h6 class="fw-bold text-center h4">Data Kosong</h6>
                                            </td>
                                        @else
                                            <td colspan="2">
                                                <h6 class="fw-bold text-center h4">Data Kosong</h6>
                                            </td>
                                        @endif
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            {{ $gudang->links('layouts.paginate') }}
        </div>
    </div>
@endsection
