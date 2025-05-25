@extends('layouts.main')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row mb-3">
            <div class="col-6">
                <x-header-sections />
            </div>
            <div class="col-6 text-end">
                <a href="javascript:void" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">+
                    Tambah</a>
            </div>
        </div>
        <hr class="text-black">
        <div class="card">
            <div class="card-body">
                @if (session('errors'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        {{ session('errors') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-striped w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Gender</th>
                                <th>Divisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data && $data->count())
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_telepon }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                    id="aksiDropdown{{ $item->id }}" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="aksiDropdown{{ $item->id }}">
                                                    <li>
                                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                                            data-bs-target="#hapusModal{{ $item->id }}">Delete</button>
                                                    </li>
                                                </ul>

                                                <!-- Modal Konfirmasi Hapus -->
                                                <div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="hapusModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="hapusModalLabel{{ $item->id }}">Konfirmasi
                                                                    Hapus</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus pengguna
                                                                <strong>{{ $item->name }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form action="{{ route('pengguna.delete', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada data tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Gender</th>
                                <th>Divisi</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('pengguna.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="no_telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Pilih Gender</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="role" class="form-label">Divisi</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="">Pilih Divisi</option>
                                    <option value="karyawan">Karyawan</option>
                                    <option value="asisten_manajer_unit">Asisten Manajer Unit</option>
                                    <option value="manajer_unit">Manajer Unit</option>
                                    <option value="asisten_manajer_sdm">Asisten Manajer SDM</option>
                                    <option value="manajer_sdm">Manajer SDM</option>
                                    <option value="direktur_operational">Direktur Operational</option>
                                    <option value="super_admin">Super Admin</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea type="text" class="form-control" id="alamat" name="alamat" required></textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="confirmation" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
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
