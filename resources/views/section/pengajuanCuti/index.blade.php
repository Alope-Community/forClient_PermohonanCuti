@extends('layouts.main')

@section('content')
<div class="container py-4">
    <x-header-sections/>
    <hr class="text-black">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm rounded p-4">
                <h4 class="text-center fw-bold">FORMULIR<br>PENGAJUAN CUTI</h4>

                {{-- Alert for session error --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Alert for validation errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('pengajuan.store') }}" class="mt-4" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control bg-secondary-subtle border border-secondary" id="tanggal_mulai" name="tanggal_mulai">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control bg-secondary-subtle border border-secondary" id="tanggal_selesai" name="tanggal_selesai">
                    </div>

                    <select name="cuti" id="cuti" class="form-select" required>
                        <option value="" disabled {{ old('cuti') ? '' : 'selected' }}>Pilih jenis cuti</option>
                        @foreach (['Tahunan', 'Besar', 'Sakit', 'Melahirkan', 'Alasan Penting', 'Bersama', 'Luar Perusahaan'] as $item)
                          <option value="{{ $item }}" {{ old('cuti') === $item ? 'selected' : '' }}>
                            {{ $item }}
                          </option>
                        @endforeach
                    </select>

                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan</label>
                        <textarea class="form-control bg-secondary-subtle border border-secondary" id="alasan" name="alasan" rows="3"
                            placeholder="Tulis alasan cuti..."></textarea>
                    </div>

                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">

                    <div class="text-center">
                        <button type="submit" class="btn px-5" style="background-color: #00BFFF">Ajukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
