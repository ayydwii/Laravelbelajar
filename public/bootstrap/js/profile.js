
    // ✅ SweetAlert untuk notifikasi sukses
    document.addEventListener('DOMContentLoaded', function() {
        if (window.profileSuccessMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: window.profileSuccessMessage,
                showConfirmButton: false,
                timer: 2000
            });
        }
    });

    // ✅ Konfirmasi sebelum hapus akun
    document.getElementById('delete-account-btn').addEventListener('click', function() {
        Swal.fire({
            title: 'Yakin ingin menghapus akun?',
            text: 'Aksi ini tidak bisa dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-account-form').submit();
            }
        });
    });

    document.getElementById('photo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const preview = document.getElementById('photo-preview');
            preview.src = URL.createObjectURL(file);
        }
    });
