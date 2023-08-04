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
                            Lihat Data Gudang
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
                                <label for="name" class="fw-bold mb-2">Nama</label>
                                <p>
                                    {{ $gudang->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
