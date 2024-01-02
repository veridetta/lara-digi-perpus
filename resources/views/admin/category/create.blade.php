@extends('layouts.templates.app', ['title' => 'Tambah Kategori'])

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="">Tambah Kategori</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.category.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
