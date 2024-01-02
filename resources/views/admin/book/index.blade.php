@extends('layouts.templates.app', ['title' => 'Dashboard'])

@section('content')

<div class="col-12 p-4 mt-4">
    <h2>List Buku</h2>
    <div class="mb-3">
        <a href="{{ route('admin.book.create') }}" class="btn btn-info">
            Tambah Buku
        </a>
        //export
        <a href="{{ route('admin.book.export') }}" class="btn btn-success">
            Export
        </a>
    </div>

    <!-- Form Pencarian dan Filter Kategori -->
    <div class="mb-3">
        <input type="text" class="form-control" id="searchInput" placeholder="Cari buku...">
    </div>
    <div class="mb-3">
        <select class="form-select" id="categoryFilter">
            <option value="" selected>Semua Kategori</option>
            <!-- Daftar kategori akan ditambahkan di sini menggunakan Blade atau JavaScript -->
        </select>
    </div>

    <!-- Daftar Buku -->
    <div class="row" id="book-cards">
        <!-- Cards will be appended here by JavaScript -->
    </div>
</div>

@endsection

@push('scripts')
<script>
$(function() {
    // Mendapatkan daftar kategori
    $.ajax({
        url: '{{ route('admin.book.categories') }}',
        method: 'GET',
        success: function(categories) {
            // Menambahkan opsi kategori ke elemen select
            categories.forEach(function(category) {
                $('#categoryFilter').append('<option value="' + category.id + '">' + category.name + '</option>');
            });
        }
    });

    // Memuat daftar buku
    loadBooks();

    // Fungsi untuk memuat daftar buku
    function loadBooks() {
        $.ajax({
            url: '{{ route('admin.book.data') }}',
            method: 'GET',
            data: {
                search: $('#searchInput').val(),
                category_id: $('#categoryFilter').val(),
            },
            beforeSend: function() {
                //clear cards
                $('#book-cards').empty();
                //tampilkan loading
                $('#book-cards').append(`
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fa fa-spinner fa-spin"></i> Memuat...
                        </div>
                    </div>
                `);
            },
            success: function(data) {
                var books = data.data;
                //clear cards
                $('#book-cards').empty();
                //jika tidak ada buku
                if (books.length == 0) {
                    $('#book-cards').append(`
                        <div class="col-12">
                            <div class="alert alert-danger text-center">
                                Tidak ada buku.
                            </div>
                        </div>
                    `);
                }
                for (var i = 0; i < books.length; i++) {
                    var card = `
                        <div class="col-12 col-md-4 mb-3 h-100">
                            <div class="card h-100">
                                <!-- Gambar buku -->
                                <img src="{{ asset('uploads/cover/') }}/${books[i].cover}" class="card-img-top" alt="${books[i].title}">
                                <div class="card-body">
                                    <!-- Judul dan deskripsi buku -->
                                    <a class="h5 card-title nav-link text-primary" href="${books[i].view_url}">${books[i].title}</a>
                                    <p class="card-text">${books[i].description}</p>
                                    <!-- Tombol Edit dan Hapus -->
                                    <a href="${books[i].edit_url}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="${books[i].delete_url}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#book-cards').append(card);
                }
            }
        });
    }

    // Fungsi untuk menangani perubahan input pencarian atau filter kategori
    $('#searchInput, #categoryFilter').on('input change', function() {
        loadBooks(); // Memuat daftar buku dengan mempertimbangkan pencarian dan filter kategori
    });
});
</script>
@endpush
