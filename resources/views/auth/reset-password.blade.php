<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .reset-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #e0f7fa, #fff);
        }

        .reset-box {
            background: #ffffff;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #00BFFF;
        }
    </style>
</head>

<body>
    <div class="reset-container">
        <div class="reset-box">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h3 class="mb-4 text-center fw-bold text-dark">Reset Password</h3>

            <form action="{{ route('auth.reset.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control shadow-sm"
                        placeholder="Masukkan email anda" required />
                </div>
                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary">Kirim Link Reset</button>
                </div>
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-decoration-none text-muted small">Kembali ke Login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
