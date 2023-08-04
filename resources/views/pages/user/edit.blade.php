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
                            Edit Data User
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
                        <form action="{{ route('user.update', ['user' => $user->id]) }}" method="post"
                            class="row justify-content-center">
                            @csrf
                            @method('put')
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label for="name" class="fw-bold mb-2">Nama</label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm"
                                    placeholder="Nama Lengkap" value="{{ $user->name }}" required>
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label for="email" class="fw-bold mb-2">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-sm"
                                    placeholder="Alamat E-mail" value="{{ $user->email }}" required>
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label for="role" class="fw-bold mb-2">Role</label>
                                <select name="role" id="role" class="form-select form-select-sm" required>
                                    <option selected hidden value="">Pilih Role Pengguna</option>
                                    @foreach ($role as $item)
                                        <option {{ $user->role_id == $item->id ? 'selected' : null }}
                                            value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label for="password" class="fw-bold mb-2">Ubah Kata Sandi</label>
                                <input type="password" name="password" id="password" class="form-control form-control-sm"
                                    placeholder="Isi apabila ingin mengganti password">
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-sm btn-outline-success fw-bold" type="submit">
                                        Edit User
                                    </button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('user.destroy', $user->id) }}" method="post"
                            class="row justify-content-center">
                            @csrf
                            @method('delete')
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-sm btn-outline-danger fw-bold" type="submit"
                                        onclick="return confirm('Hapus Data User?')">
                                        Hapus Data User
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
