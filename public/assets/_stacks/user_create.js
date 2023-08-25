        $(document).ready(function() {
            $("#user-form").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/admin",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                        }).then(function() {
                            window.location.href = '/admin';
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: xhr.responseJSON.error, // Menampilkan pesan kesalahan yang lebih spesifik
                            });
                        }
                    }
                });
            });
        });