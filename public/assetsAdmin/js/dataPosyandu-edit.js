document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('editForm');
    const btnUpdate = document.getElementById('btnUpdate');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Konfirmasi Update',
            text: "Apakah kamu yakin ingin memperbarui data Posyandu ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, update sekarang!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    if (window.successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: window.successMessage,
            showConfirmButton: false,
            timer: 1800,
            background: '#d6f5d6',
            color: '#1b2d2a'
        });
    }
});
