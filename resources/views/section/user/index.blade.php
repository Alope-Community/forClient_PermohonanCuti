@extends('layouts.main')

@section('content')
<div class="main p-4 ms-3 mt-3">
    <h1 class="mb-4 fw-bold">Halo, Admin</h1>
    <hr class="text-black">

    <div class="d-flex justify-content-center align-items-center">
        <div class="card shadow-sm border-1 p-4" style="width: 600px;">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-person-fill text-black" style="font-size: 4rem;"></i>
                <span class="ms-3 fw-medium fs-5">Sindi</span>
            </div>
            <div class="mt-3">
                <span class="fw-bold text-uppercase">Profile</span>
                <hr>

                <p><strong>Nama:</strong> Sindi</p>
                <p><strong>Email:</strong> sindi@example.com</p>
                <p><strong>Gender:</strong> Perempuan</p>
                <p><strong>Alamat:</strong> Jl. Melati No. 12</p>
                <p><strong>Nomor Telepon:</strong> 08123456789</p>
                <p><strong>Role:</strong> Admin</p>

                <div class="mt-4 text-end">
                    <a href="/user/panel/edit" class="btn btn-primary">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection