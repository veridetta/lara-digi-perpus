@extends('layouts.templates.app', ['title' => 'Dashboard'])

@section('content')

<div class="col-12 p-4 mt-4">
    <h2>Data Kategori</h2>
    <div class="mb-3">
        <a href="{{ route('admin.category.create') }}" class="btn btn-info">
            Tambah Kategori
        </a>
    </div>
    <table class="table" id="kategoriTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        // Inisialisasi DataTable
        var table = $('#kategoriTable').DataTable({
            ajax: {
                url: '{{ route('admin.category.get-data') }}', // Ganti dengan URL sesuai kebutuhan
                dataSrc: ''
            },
            columns: [
                { data: null },
                { data: 'nama' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<a href="/admin/category/edit/' + row.id + '" class="btn btn-warning btn-sm">Ubah</a>' +
                            ' <button class="btn btn-danger btn-sm" onclick="hapusKriteria(' + row.id + ')">Hapus</button>';
                    }
                }
            ],
            columnDefs: [
                {
                    targets: 0,
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }
            ],
        });

        // Filter Pencarian
        $('#kategoriTable').on('keyup', 'tfoot input', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
        });
    });

    // Fungsi untuk menghandle aksi hapus
    function hapusKriteria(id) {
        // Implementasikan logika hapus data (misalnya menggunakan konfirmasi)
        if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
            // Redirect atau jalankan skrip hapus data
            window.location.href = '/admin/category/delete/' + id;
        }
    }
</script>


@endsection
