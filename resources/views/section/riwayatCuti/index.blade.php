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
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data && $data->count())
                            @foreach ($data as $index => $item)
                                <tr>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}</td>
                                    <td style="white-space: normal; word-break: break-word;">{{ $item->alasan }}</td>
                                    <td>
                                        @if ($item->status == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif ($item->status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'disetujui')
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                    id="aksiDropdown{{ $item->id }}" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="aksiDropdown{{ $item->id }}">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('pengguna.edit', $item->id) }}">Lihat Surat Balasan</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <span class="text-muted">Menunggu jawaban</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data cuti.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>
@endsection
