@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.sidebar')
        @livewire('report', ['data' => $data])
    </div>
@endsection
