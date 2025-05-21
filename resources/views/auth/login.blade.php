<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
        }

        .left-side {
            background: url('/image/login.jpg') no-repeat center center;
            background-size: cover;
            width: 50%;
        }

        .right-side {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50%;
            background-color: #fff;
        }

        .login-box {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            background-color: #fff;

        }

        .form-control:focus {
            box-shadow: none;
            border-color: #2D3748;
        }


        @media (max-width: 767.98px) {
            .login-container {
                background: url('/image/login.jpg') no-repeat center center;
                background-size: cover;
                flex-direction: column;
                padding: 2rem;
            }

            .left-side {
                display: none;
            }

            .right-side {
                width: 100%;
                background-color: transparent;
                padding: 1rem;
            }

            .login-box {
                background-color: #fff;
                border-radius: 8px;
                padding: 2rem;
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">

        <div class="left-side d-none d-md-block"></div>


        <div class="right-side">
            <div class="login-box">
                <h2 class="mb-4 fw-bold text-dark">Login</h2>
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible aler-sm fade show" role="alert">
                        {{ session('error') }}
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
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="********" required />
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>
