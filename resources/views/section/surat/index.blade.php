@extends('layouts.main')

@section('content')
<div class="main p-4 ms-3 mt-3">
    <h1 class="mb-4 fw-bold">Surat Balasan Cuti</h1>
    <hr class="text-black">
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card shadow-sm rounded p-5" style="width: 100%; max-width: 700px;">
            <h4 class="text-center fw-bold mb-5">FORMULIR<br>SURAT BALASAN CUTI</h4>

            <form id="formBalasanCuti" novalidate>
                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="nama" class="col-form-label">Nama Karyawan</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control bg-secondary-subtle border border-secondary" id="nama" name="nama" placeholder="Masukkan nama" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="tanggal_cuti" class="col-form-label">Tanggal Cuti</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="date" class="form-control bg-secondary-subtle border border-secondary" id="tanggal_cuti" name="tanggal_cuti" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="lama_cuti" class="col-form-label">Lama Cuti (hari)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="number" min="1" class="form-control bg-secondary-subtle border border-secondary" id="lama_cuti" name="lama_cuti" placeholder="Lama cuti" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-start">
                    <div class="col-sm-4">
                        <label for="alasan_cuti" class="col-form-label">Alasan Cuti</label>
                    </div>
                    <div class="col-sm-8">
                        <textarea class="form-control bg-secondary-subtle border border-secondary" id="alasan_cuti" name="alasan_cuti" rows="3" placeholder="Tulis alasan cuti..." required></textarea>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="status" class="col-form-label">Status Persetujuan</label>
                    </div>
                    <div class="col-sm-8">
                        <select id="status" name="status" class="form-select bg-secondary-subtle border border-secondary" required>
                            <option value="" disabled selected>Pilih status</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4 align-items-start">
                    <div class="col-sm-4">
                        <label for="catatan" class="col-form-label">Catatan (Opsional)</label>
                    </div>
                    <div class="col-sm-8">
                        <textarea class="form-control bg-secondary-subtle border border-secondary" id="catatan" name="catatan" rows="2" placeholder="(Jika ada)"></textarea>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5">Kirim Balasan</button>
                </div>
            </form>

            <div id="hasilBalasan" class="mt-4"></div>
        </div>
    </div>
</div>

<script>
    document.getElementById('formBalasanCuti').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        const data = {
            nama: form.nama.value,
            tanggal_cuti: form.tanggal_cuti.value,
            lama_cuti: form.lama_cuti.value,
            alasan_cuti: form.alasan_cuti.value,
            status: form.status.value,
            catatan: form.catatan.value,
        };

        const hasil = `
        <div class="card border-success p-3">
            <h5>Surat Balasan Cuti</h5>
            <p><strong>Nama:</strong> ${data.nama}</p>
            <p><strong>Tanggal Cuti:</strong> ${data.tanggal_cuti}</p>
            <p><strong>Lama Cuti:</strong> ${data.lama_cuti} hari</p>
            <p><strong>Alasan Cuti:</strong> ${data.alasan_cuti}</p>
            <p><strong>Status:</strong> ${data.status.toUpperCase()}</p>
            <p><strong>Catatan:</strong> ${data.catatan || '-'}</p>
        </div>
    `;

        document.getElementById('hasilBalasan').innerHTML = hasil;

        form.reset();
        form.classList.remove('was-validated');
    });
</script>

@endsection