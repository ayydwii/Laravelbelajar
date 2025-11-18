@extends('layouts.app')


@section('content')
<div class="container">

    {{-- ✅ SweetAlert untuk notifikasi sukses --}}
    @if (session('success'))
        <script>
            window.profileSuccessMessage = "{{ session('success') }}";
        </script>
    @endif

    <h2 class="mb-4 text-center">Pengaturan Akun</h2>

    <div class="profile-section">

        {{-- 🔹 Informasi Profil --}}
        <div class="profile-card">
            <h3>Informasi Profil</h3>
            <p>Perbarui informasi akun dan alamat email Anda di sini.</p>

            <form id="profile-update-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- Foto Profil --}}
                <div class="text-center mb-3">
                    <label for="photo" style="cursor: pointer;">
                        <img id="photo-preview"
                            src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-user.png') }}"
                            alt="Foto Profil"
                            width="120" height="120"
                            class="rounded-circle object-fit-cover shadow"
                            style="cursor: pointer;">

                    </label>
                    <input type="file" id="photo" name="photo" accept="image/*" style="display: none;">
                    <p class="text-muted small">Klik foto untuk mengubah</p>
                </div>


                {{-- == NAMA == --}}
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                </div>

                {{-- == EMAIL == --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>

        {{-- 🔹 Ubah Password --}}
        <div class="profile-card">
            <h3>Ubah Password</h3>
            <p>Pastikan akunmu menggunakan password yang panjang dan acak untuk menjaga keamanan.</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Password</button>
            </form>
        </div>

    </div>

    {{-- 🔹 Tombol Hapus Akun & Perbarui --}}
    <div>
        <div class="d-flex justify-content-end gap-3 mt-5 mb-5">
            {{-- Tombol Hapus Akun --}}
            <form id="delete-account-form" method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')
                <button type="button" class="delete-btn" id="delete-account-btn">
                    Hapus Akun
                </button>
            </form>

            {{-- Tombol Perbarui --}}
            <button type="submit" form="profile-update-form" class="btn btn-primary">
                Perbarui
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('bootstrap/js/profile.js') }}"></script>
@endpush
