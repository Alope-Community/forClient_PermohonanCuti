@extends('layouts.main')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row mb-3">
            <div class="col-6">
                <h1 class="fw-bold">Halo, Admin</h1>
            </div>
            <div class="col-6 text-end">
                <a href="#" class="btn btn-sm btn-primary">+ Tambah</a>
            </div>
        </div>
        <hr class="text-black">
        <div class="card">
            <div class="card-body">
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
                                                        <a class="dropdown-item"
                                                            href="{{ route('pengguna.edit', $item->id) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('pengguna.delete', $item->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="dropdown-item text-danger">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
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
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
