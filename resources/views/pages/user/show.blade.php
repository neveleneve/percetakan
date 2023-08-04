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
                            Lihat Data User
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
                                    {{ $user->name }}
                                </p>
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label for="email" class="fw-bold mb-2">Email</label>
                                <p>
                                    {{ $user->email }}
                                </p>
                            </div>
                            <div class="col-12 col-lg-10 text-center mb-3">
                                <label for="role" class="fw-bold mb-2">Role</label>
                                <p>
                                    {{ $user->role->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
