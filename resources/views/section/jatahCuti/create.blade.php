@extends('layouts.main')

@section('content')
<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="namaTambah" class="form-label">Nama</label>
            <input type="text" class="form-control" id="namaTambah" placeholder="Masukkan nama">
          </div>
          <div class="mb-3">
            <label for="emailTambah" class="form-label">Email</label>
            <input type="email" class="form-control" id="emailTambah" placeholder="Masukkan email">
          </div>
          <!-- Tambahkan field lain sesuai kebutuhan -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

@endsection