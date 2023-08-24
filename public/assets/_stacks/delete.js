
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-btn')) {
                const entityId = e.target.getAttribute('data-id');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menghapus items ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`${entityId}`, {
                            method: 'DELETE',
                            headers: {
                               
                                'X-CSRF-TOKEN': csrfToken
                            }
                        }).then(response => {
                            if (response.ok) {
                                Swal.fire(
                                    'Terhapus!',
                                    'Item telah dihapus.',
                                    'success'
                                ).then(() => {
                                    window.location.reload(); // Ini akan memuat ulang halaman
                                });
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus item.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }
        });
   