@extends('layouts.main')

@section('content')
<div class="main p-4 ms-3 mt-3">
    <h1 class="mb-4 fw-bold">Halo, Admin</h1>
    <hr class="text-black">
      <div class="row mb-4">
        <div class="col-md-6">
            <input type="text" class="form-control custom-input" placeholder="Cari data...">
        </div>
      </div>
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
          <tr>
            <td>Rizki</td>
            <td>2025-06-01</td>
            <td>2025-06-10</td>
            <td>Liburan keluarga</td>
            <td><span class="badge bg-success">Disetujui</span></td>
          </tr>
          <tr>
            <td>Ayu</td>
            <td>2025-07-05</td>
            <td>2025-07-10</td>
            <td>Sakit</td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection