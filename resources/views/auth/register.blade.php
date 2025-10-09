<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="ayu/css/custom.css">
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="card shadow-lg p-4 rounded-4" style="width: 600px;">
        <h3 class="text-center text-dark mb-4 fw-semibold">Buat Akun Baru</h3>

        @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-success">
                        {{ session('error') }}
                    </div>
                @endif

        <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="username" class="form-label text-dark">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required autofocus>
                    @error('username')
                        <div class="text-danger mt-1" style="font-size: 0.875em;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label text-dark">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                    @error('name')
                        <div class="text-danger mt-1" style="font-size: 0.875em;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="email" class="form-label text-dark">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                    @error('email')
                        <div class="text-danger mt-1" style="font-size: 0.875em;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label text-dark">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    @error('password')
                        <div class="text-danger mt-1" style="font-size: 0.875em;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label text-dark">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    @error('password_confirmation')
                        <div class="text-danger mt-1" style="font-size: 0.875em;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="photo" class="form-label text-dark">Foto</label>
                    <input type="file" id="photo" name="photo" class="form-control">
                    @error('photo')
                        <div class="text-danger mt-1" style="font-size: 0.875em;">{{ $message }}</div>
                    @enderror
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

