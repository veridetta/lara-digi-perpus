@extends('layouts.templates.app', ['title' => $book->title])

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <img src="{{ asset('uploads/cover/' . $book->cover) }}" class="card-img-top" alt="{{ $book->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Kategori : {{ $book->category->name }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Jumlah: {{$book->amount}}</h6>
                    <p class="mb-0">Deskripsi :</p>
                    <p class="card-text">{{ $book->description }}</p>
                    <iframe src="{{ asset('uploads/pdf/' . $book->pdf) }}" style="width:100%;height:500px;"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
