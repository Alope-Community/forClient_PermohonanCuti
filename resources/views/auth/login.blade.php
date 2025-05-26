<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
    }

    .login-container {
      min-height: 100vh;
      margin: 0;
      padding: 0;
    }

    .bg-cover {
      background: url('/image/login.jpg') no-repeat center center;
      background-size: cover;
      height: 100vh;
      width: 100%;
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #2D3748;
    }

    /* Mobile & Tablet */
    @media (max-width: 991.98px) {
      .login-container {
        background: url('/image/login.jpg') no-repeat center center;
        background-size: cover;
        padding: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .form-wrapper {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 0.5rem;
        padding: 2rem;
        width: 100%;
        max-width: 500px;
        margin-inline: 1rem; /* Tambahkan jarak kiri-kanan di mobile & tablet */
      }

      .bg-cover {
        display: none !important;
      }
    }
  </style>
</head>

<body>
  <div class="container-fluid login-container d-flex flex-column flex-lg-row p-0 m-0">
    <!-- Left side (image only for lg and up) -->
    <div class="d-none d-lg-block col-lg-6 p-0 m-0">
      <div class="bg-cover"></div>
    </div>

    <!-- Right side (form) -->
    <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
      <div class="form-wrapper w-100" style="max-width: 500px;">
        <h2 class="mb-4 fw-bold text-dark">Login</h2>

        @if (session('errors'))
        <div class="alert alert-danger alert-dismissible alert-sm fade show" role="alert">
          {{ session('errors')->first('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('auth.login.post') }}" enctype="multipart/form-data" method="POST">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control shadow-sm"
              placeholder="Masukan Akun Email Anda" required />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group shadow-sm">
              <input type="password" id="password" name="password" class="form-control" placeholder="********"
                required />
              <span class="input-group-text">
                <i class="bi bi-eye" id="togglePassword" style="cursor: pointer;"></i>
              </span>
            </div>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-dark">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
