<section class="bg-white shadow-sm rounded-3xl p-5 border border-gray-100 mt-5">
    <header class="mb-4">
        <h2 class="text-lg font-semibold text-gray-800">
            {{ __('Ubah Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Pastikan akunmu menggunakan password yang panjang dan acak untuk menjaga keamanan.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <!-- Password Saat Ini -->
        <div>
            <label for="update_password_current_password" class="form-label fw-bold text-secondary">
                Password Saat Ini
            </label>
            <input type="password" id="update_password_current_password" name="current_password"
                class="form-control shadow-sm" autocomplete="current-password">
            @if ($errors->updatePassword->get('current_password'))
                <div class="text-danger small mt-1">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <!-- Password Baru -->
        <div>
            <label for="update_password_password" class="form-label fw-bold text-secondary">
                Password Baru
            </label>
            <input type="password" id="update_password_password" name="password"
                class="form-control shadow-sm" autocomplete="new-password">
            @if ($errors->updatePassword->get('password'))
                <div class="text-danger small mt-1">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <label for="update_password_password_confirmation" class="form-label fw-bold text-secondary">
                Konfirmasi Password
            </label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation"
                class="form-control shadow-sm" autocomplete="new-password">
            @if ($errors->updatePassword->get('password_confirmation'))
                <div class="text-danger small mt-1">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4 py-2">
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small m-0">
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
