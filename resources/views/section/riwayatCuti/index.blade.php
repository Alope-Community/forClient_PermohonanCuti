@extends('layouts.main')

@section('content')
    <div class="main p-4 ms-3 mt-3">
        <h1 class="mb-4 fw-bold">Halo, Admin</h1>
        <hr class="text-black">
        @if (session('sucsess'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('sucsess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Alasan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data && $data->count())
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}</td>
                                        <td>{{ $item->alasan }}</td>
                                        <td>
                                            @if ($item->status == 'disetujui')
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif ($item->status == 'ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data cuti.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
