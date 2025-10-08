<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0d0d16, #1c1c29, #111);
            min-height: 100vh;
        }
        .card {
            background-color: #1e1e2f;
        }
        .form-control {
            background-color: #2b2b3d;
            color: #fff;
            border: none;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.5);
        }
        .btn-primary {
            background-color: #6366f1;
            border: none;
        }
        .btn-primary:hover {
            background-color: #4f46e5;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="card shadow-lg p-4 rounded-4" style="width: 600px;">
        <h3 class="text-center text-light mb-4 fw-semibold">Buat Akun Baru</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="username" class="form-label text-light">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required autofocus>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label text-light">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="col-12">
                    <label for="email" class="form-label text-light">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label text-light">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label text-light">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4 py-2 fw-semibold rounded-3 shadow-sm">Daftar</button>

            <p class="text-center text-secondary mt-3">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-info text-decoration-none">Login di sini</a>
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

