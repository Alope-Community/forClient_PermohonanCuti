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
                        <thead class="table-dark">
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Jumlah Cuti</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->user->name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($item->tanggal_selesai)) + 1 }} Hari</td>
                                    <td>{{ $item->alasan }}</td>
                                    <td><span class="text-success">Di{{ $item->status }} </span>oleh: Semua Atasan</td>
                                    <td>
                                        <a href="{{ route('penerbitan.store', $item->id) }}">Terbitkan Surat</a>
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
