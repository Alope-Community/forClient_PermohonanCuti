@extends('layouts.main')

@section('content')
    <div class="main p-3 p-md-4 ms-md-3 mt-3">
        <h1 class="mb-4 fw-bold">
            <x-header-sections />
        </h1>
        <hr class="text-black">


        <div class="d-flex ">
            <div class="card shadow-sm border-1 p-4" style="max-width: 600px; width: 100%;">
                {{-- Session Success/Error Messages --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                    <div class="mt-3">
                        <form action="{{ route('jatah-cuti.upadte', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-lg-12">
                                    <label for="nama" class="form-label">Nama Karyawan</label>
                                    <select name="users_id" id="users_id" class="form-select" disabled
                                        style="width: 100%; height: 50%">
                                        <option value=""></option>
                                        @foreach ($karyawan as $item)
                                            <option value="{{ $item->id }}"
                                                {{ isset($data) && $data->users_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="users_id" value="{{ $data->users_id }}">
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input readonly type="date" class="form-control" id="tahun" name="tahun"
                                        value="{{ isset($data) ? $data->tahun : \Carbon\Carbon::now()->format('Y') . '-01-01' }}">
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="total_jatah" class="form-label">Total Jatah</label>
                                    <input type="number" class="form-control" id="total_jatah" name="total_jatah"
                                        value="{{ isset($data) ? $data->total_jatah : old('total_jatah') }}">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
