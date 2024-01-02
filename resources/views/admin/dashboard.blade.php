@extends('layouts.templates.app', ['title' => 'Dashboard'])

@section('content')

<div class="col-12">
    <p class="h1 text-center">Dashboard</p>
    <p class="h3 text-center">Selamat Datang {{ Auth::user()->name }}</p>
    <p class="text-center">Selamat datang di halaman dashboard, silahkan pilih menu yang tersedia di sidebar.</p>
</div>

@endsection
