@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.sidebar')
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header text-bg-success">
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-outline-light">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <span class="fw-bold">
                            Tambah Data User
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
                        <form action="{{ route('user.store') }}" method="post" class="row justify-content-center">
                            @csrf
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label for="name" class="fw-bold mb-2">Nama</label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm"
                                    placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label for="email" class="fw-bold mb-2">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-sm"
                                    placeholder="Alamat E-mail" required>
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label for="role" class="fw-bold mb-2">Role</label>
                                <select name="role" id="role" class="form-select form-select-sm" required>
                                    <option selected hidden value="">Pilih Role Pengguna</option>
                                    @foreach ($role as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-10">
                                <span class="text-danger fw-bold">
                                    Password default user ialah "12345678" (Tanpa tanda kutip)
                                </span>
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-sm btn-outline-success fw-bold" type="submit">
                                        Tambah User
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
