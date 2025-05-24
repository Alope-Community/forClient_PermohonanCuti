@extends('layouts.main')

@section('content')
   <!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="namaEdit" class="form-label">Nama</label>
            <input type="text" class="form-control" id="namaEdit" value="Nama Lama">
          </div>
          <div class="mb-3">
            <label for="emailEdit" class="form-label">Email</label>
            <input type="email" class="form-control" id="emailEdit" value="email@lama.com">
          </div>
          <!-- Tambahkan field lain sesuai kebutuhan -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

@endsection