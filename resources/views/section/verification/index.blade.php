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
                        <thead class="text-center" style="background-color: #00BFFF">
                            <tr>
                                <th>Nama</th>
                                <th>Divisi</th>
                                <th>Tanggal Update</th>
                                <th>Keterangan</th>
                                <th>Jenis Cuti</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatCuti as $item)
                                <tr>
                                    <td>{{ $item->cuti->user->name ?? '-' }}</td>
                                    <td>{{ $item->cuti->user->divisi ?? '-' }}</td>
                                    <td>{{ $item->tanggal_update }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->cuti->cuti }}</td>
                                    <td>Diverifikasi oleh: {{ ucwords(str_replace('_', ' ', $item->status)) }}</td>
                                    <td>
                                        <a href="{{ route('cuti.verifikasi.edit', $item->id) }}">Lihat Detail</a>
                                    </td>
                                </tr>
                            @endforeach
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
