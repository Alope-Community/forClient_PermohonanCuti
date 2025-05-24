@extends('layouts.main')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row mb-3">
            <div class="col-6">
                <h1 class="fw-bold">Data Jatah Cuti</h1>
            </div>
        </div>
        <hr class="text-black">
        <div class="card">
            <div class="card-body">
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
                            <tr>
                                <td>1</td>
                                <td>Kevin</td>
                                <td>2025-01-01</td>
                                <td>12</td>
                                <td>5</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button></li>
                                            <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hapusModal">Delete</button></li>
                                        </ul>
                                    </div>
                                    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-danger">Hapus</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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
