@extends('layouts.templates.app', ['title' => 'Dashboard'])

@section('content')

<div class="col-12 p-4 mt-4">
    <h2>Data Kategori</h2>
    <div class="mb-3">
        <a href="{{ route('admin.category.create') }}" class="btn btn-info">
            Tambah Kategori
        </a>
    </div>
    <div class="table-responsive w-100 col-12">
        <table id="category-table" class="table table-striped table-bordered w-100">
            <thead class="">
                <tr class="">
                    <th class="bg-danger fw-bold text-white" style="width: 10%;">No</th>
                    <th style="width: 70%;" class="bg-danger fw-bold text-white">Nama Kategori</th>
                    <th style="width: 20%;" class="bg-danger fw-bold text-white">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(function() {
    $('#category-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.category.data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush
