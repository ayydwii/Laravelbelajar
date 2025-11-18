document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // stop dulu sebelum submit
                const confirmed = confirm('Apakah Anda yakin ingin menghapus user ini?');
                if (confirmed) {
                    alert('User berhasil dihapus!');
                    form.submit(); // lanjutkan hapus
                }
            });
        });
    });
