@extends('layouts.templates.app', ['title' => 'Edit Buku'])

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="">Edit Buku</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.book.update', $book->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" required>{{ $book->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="{{ $book->amount }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="pdf" class="form-label">PDF</label>
                            <a href="{{ asset('uploads/pdf/' . $book->pdf) }}" target="_blank">Preview PDF</a>
                            <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin merubah</small>
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Cover</label>
                            <br>
                            <img src="{{ asset('uploads/cover/' . $book->cover) }}" alt="{{ $book->title }}" class="mb-3">
                            <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin merubah</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
