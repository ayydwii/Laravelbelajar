<section class="bg-white shadow-sm rounded-3xl p-5 border border-gray-100 mt-5">
    <header class="mb-4">
        <h2 class="text-lg font-semibold text-danger">
            {{ __('Hapus Akun') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Setelah akun kamu dihapus, semua data akan dihapus secara permanen. Pastikan kamu sudah menyimpan informasi penting sebelum melanjutkan.') }}
        </p>
    </header>

    <!-- Tombol Buka Modal -->
    <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        {{ __('Hapus Akun') }}
    </button>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3xl border-0 shadow">
                <div class="modal-header bg-danger text-white rounded-top-3">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">{{ __('Konfirmasi Hapus Akun') }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-sm text-gray-700">
                        {{ __('Apakah kamu yakin ingin menghapus akun ini secara permanen? Semua data akan hilang dan tidak bisa dikembalikan.') }}
                    </p>

                    <form method="post" action="{{ route('profile.destroy') }}" id="deleteAccountForm" class="mt-4">
                        @csrf
                        @method('delete')

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold text-secondary">
                                {{ __('Masukkan Password untuk Konfirmasi') }}
                            </label>
                            <input type="password" id="password" name="password"
                                    class="form-control shadow-sm" placeholder="Password kamu" required>
                            @if ($errors->userDeletion->get('password'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                        {{ __('Batal') }}
                    </button>

                    <button type="submit" form="deleteAccountForm" class="btn btn-danger px-4">
                        {{ __('Hapus Akun') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
