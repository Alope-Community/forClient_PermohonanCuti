@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <x-header-sections />
    <hr class="text-black">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-striped align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Alasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Firdan Fauzan</td>
                            <td>2025-06-01</td>
                            <td>2025-06-05</td>
                            <td>Liburan keluarga</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary">
                                    Lihat Detail
                                </button>


                            </td>
                        </tr>
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection