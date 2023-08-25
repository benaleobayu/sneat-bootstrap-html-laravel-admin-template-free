    document.addEventListener('DOMContentLoaded', function () {
        // Validasi unik untuk username dan email
        document.getElementById('user-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const usernameInput = document.getElementById('username');
            const emailInput = document.getElementById('email');
            
            // Lakukan validasi unik di sini (misalnya, dengan AJAX ke server)
            // Gantilah dengan cara Anda memeriksa uniknya username dan email
            const isUsernameUnique = true; // Gantilah dengan hasil validasi yang sesuai
            const isEmailUnique = true; // Gantilah dengan hasil validasi yang sesuai

            if (!isUsernameUnique || !isEmailUnique) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Username or email is not unique. Please choose a different one.',
                });
            } else {
                // Jika username dan email unik, submit formulir
                this.submit();
            }
        });
    });
