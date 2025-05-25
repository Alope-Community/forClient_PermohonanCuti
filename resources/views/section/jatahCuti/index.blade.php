@extends('layouts.main')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row mb-3">
            <div class="col-6">
                <x-header-sections />
            </div>
            <div class="col-6 text-end">
                <!-- Tambah Button with Modal Trigger -->
                <a href="javascript:void" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">+
                    Tambah</a>
            </div>
        </div>
        <hr class="text-black">
        <div class="card">
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-striped w-100">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tahun</th>
                                <th>Total Jatah</th>
                                <th>Sisa Jatah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jatahCuti as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->users->name ?? '-' }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->total_jatah }}</td>
                                    <td>{{ $item->sisa_jatah }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal">Edit</button></li>
                                                <li><button class="dropdown-item text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#hapusModal">Delete</button></li>
                                            </ul>
                                        </div>
                                        <div class="modal fade" id="hapusModal" tabindex="-1"
                                            aria-labelledby="hapusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="button" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Jatah Cuti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="{{ route('jatah-cuti.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Karyawan</label>
                                <select name="users_id" id="users_id" class="form-select form-select-md"
                                    style="width: 100%; height: 20%">
                                    <option value=""></option>
                                    @foreach ($karyawan as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="date" class="form-control" id="tahun" name="tahun"
                                value="{{ \Carbon\Carbon::now()->format('Y') . '-01-01' }}">
                        </div>
                        <div class="mb-3">
                            <label for="total_jatah" class="form-label">Total Jatah</label>
                            <input type="number" class="form-control" id="total_jatah" name="total_jatah"
                                value="{{ old('total_jatah') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
            $('#users_id').select2({
                placeholder: '-- Pilih Karyawan --',
                allowClear: true,
                dropdownParent: $('#tambahModal')
            });
        });
    </script>
@endsection
