<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('ayu/css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-dark bg-gradient">
        <div class="card shadow-lg border-0 rounded-4" style="width: 400px; background-color: #1e1e2f;">
            <div class="card-body text-light">
                <h3 class="text-center mb-4 fw-semibold">Selamat Datang</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label text-light">Username</label>
                        <input type="text" id="username" name="username" class="form-control bg-dark text-light border-0 shadow-sm" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-light">Password</label>
                        <input type="password" id="password" name="password" class="form-control bg-dark text-light border-0 shadow-sm" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold shadow">
                        Login
                    </button>

                    <p class="text-center mt-4 text-secondary">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-info text-decoration-none">Daftar Sekarang</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

