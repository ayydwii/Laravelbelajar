<section class="bg-white shadow-sm rounded-3xl p-5 border border-gray-100">
    <header class="mb-4">
        <h2 class="text-lg font-semibold text-gray-800">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __("Perbarui informasi akun dan alamat email Anda di sini.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <!-- Input Nama -->
        <div>
            <label for="name" class="form-label fw-bold text-secondary">Nama</label>
            <input type="text" name="name" id="name"
                class="form-control shadow-sm"
                value="{{ old('name', $user->name) }}"
                required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input Email -->
        <div>
            <label for="email" class="form-label fw-bold text-secondary">Email</label>
            <input type="email" name="email" id="email"
                class="form-control shadow-sm"
                value="{{ old('email', $user->email) }}"
                required autocomplete="username">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-700">
                        {{ __('Email kamu belum diverifikasi.') }}
                        <button form="send-verification" type="submit"
                            class="text-primary text-decoration-underline border-0 bg-transparent p-0">
                            {{ __('Kirim ulang link verifikasi') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 small text-success">
                            {{ __('Link verifikasi baru telah dikirim ke email kamu.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4 py-2">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small m-0"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
