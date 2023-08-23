
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-btn')) {
                const entityId = e.target.getAttribute('data-id');
    
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
                        fetch(`/admin/${entityId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
   