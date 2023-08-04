@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.sidebar')
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header text-bg-success">
                        <a href="{{ route('gudang.index') }}" class="btn btn-sm btn-outline-light">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <span class="fw-bold">
                            Edit Data Gudang
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
                        <form action="{{ route('gudang.update', ['gudang' => $gudang->id]) }}" method="post"
                            class="row justify-content-center">
                            @csrf
                            @method('put')
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label for="name" class="fw-bold mb-2">Nama</label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm"
                                    placeholder="Nama Gudang" value="{{ $gudang->name }}" required>
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-sm btn-outline-success fw-bold" type="submit">
                                        Edit Gudang
                                    </button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('gudang.destroy', $gudang->id) }}" method="post"
                            class="row justify-content-center">
                            @csrf
                            @method('delete')
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-sm btn-outline-danger fw-bold" type="submit"
                                        onclick="return confirm('Hapus Data Gudang?')">
                                        Hapus Data Gudang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
