@extends('layouts.main')

@section('content')
<div class="main p-3 p-md-4 ms-md-3 mt-3">
    <h1 class="mb-4 fw-bold">
         <x-header-sections/>
    </h1>
    <hr class="text-black">


    <div class="d-flex ">
        <div class="card shadow-sm border-1 p-4" style="max-width: 600px; width: 100%;">
            {{-- Session Success/Error Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
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
                <i class="bi bi-person-fill text-black" style="font-size: 4rem;"></i>
                <span class="mt-3 mt-sm-0 ms-sm-3 fw-medium fs-5 text-break text-center text-sm-start">{{ $user->name }}</span>
            </div>
            <div class="mt-3">
                <span class="fw-bold text-uppercase">Profile</span>
                <hr>

                <form action="{{ route('user.profile.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label"><strong>Nama</strong></label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Email</strong></label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Gender</strong></label>
                        <select name="gender" class="form-select" required>
                            <option value="Pria" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Wanita" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Alamat</strong></label>
                        <input type="text" name="alamat" class="form-control" value="{{ $user->alamat }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Nomor Telepon</strong></label>
                        <input type="text" name="no_telepon" class="form-control" value="{{ $user->no_telepon }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Role</strong></label>
                        <input type="text" class="form-control" value="{{ $user->role }}" readonly>
                    </div>
                    <div class="mt-4 d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            Ganti Password
                        </button>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ganti Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('user.profile.changerPassword', $user->id) }}" method="POST" class="modal-content">
    @method('PUT')
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Ganti Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Password Lama</label>
          <input type="password" name="current_password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password Baru</label>
          <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Konfirmasi Password Baru</label>
          <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Update Password</button>
      </div>
    </form>
  </div>
</div>
@endsection
