@extends('layouts.main')

@section('content')
    <div class="main p-4 ms-3 mt-3"> <x-header-sections/>
        <hr class="text-black">
        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="card shadow-sm rounded p-5" style="width: 100%; max-width: 700px;">
                <h4 class="text-center fw-bold">FORMULIR<br>PENGAJUAN CUTI</h4>
                {{-- Alert for session error --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Alert for validation errors --}}
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
                <form action="{{ route('pengajuan.store') }}" class="mt-5" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4">
                            <label for="tanggal_mulai" class="col-form-label">Tanggal Mulai</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="date" class="form-control bg-secondary-subtle border border-secondary"
                                id="tanggal_mulai" name="tanggal_mulai">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4">
                            <label for="tanggal_selesai" class="col-form-label">Tanggal Selesai</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="date" class="form-control bg-secondary-subtle border border-secondary"
                                id="tanggal_selesai" name="tanggal_selesai">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-start">
                        <div class="col-sm-4">
                            <label for="alasan" class="col-form-label">Alasan</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control bg-secondary-subtle border border-secondary" id="alasan" name="alasan" rows="3"
                                placeholder="Tulis alasan cuti..."></textarea>
                        </div>
                    </div>
                    <input type="number" hidden value="{{ auth()->user()->id }}" name="user_id">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">Ajukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
